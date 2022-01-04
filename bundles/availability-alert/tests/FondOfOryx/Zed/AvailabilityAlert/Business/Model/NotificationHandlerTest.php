<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class NotificationHandlerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Notification\NotificationPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->pluginMock = $this->getMockBuilder(NotificationPluginInterface::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePreCheckPluginsWillReturnTrue(): void
    {
        $this->pluginMock->expects(static::once())->method('notify');
        $executor = new NotificationHandler([$this->pluginMock]);

        $executor->execute($this->subscriptionTransferMock);
    }
}
