<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class SubscribersNotifierPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPreCheckPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->pluginMock = $this->getMockBuilder(SubscribersNotifierPreCheckPluginInterface::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePreCheckPluginsWillReturnTrue(): void
    {
        $this->pluginMock->expects(static::once())->method('checkCondition')->willReturn(true);
        $executor = new SubscribersNotifierPluginExecutor([$this->pluginMock]);

        $result = $executor->executePreCheckPlugins($this->subscriptionTransferMock);

        static::assertTrue($result);
    }

    /**
     * @return void
     */
    public function testExecutePreCheckPluginsWillReturnFalse(): void
    {
        $this->pluginMock->expects(static::once())->method('checkCondition')->willReturn(false);
        $executor = new SubscribersNotifierPluginExecutor([$this->pluginMock]);

        $result = $executor->executePreCheckPlugins($this->subscriptionTransferMock);

        static::assertFalse($result);
    }
}
