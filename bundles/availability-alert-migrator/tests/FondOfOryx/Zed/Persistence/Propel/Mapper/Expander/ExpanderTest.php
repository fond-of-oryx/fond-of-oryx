<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;

class ExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fosAvailabilityAlertSubscriptionEntityTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\Expander
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->fosAvailabilityAlertSubscriptionEntityTransferMock = $this->getMockBuilder(FosAvailabilityAlertSubscriptionEntityTransfer::class)->disableOriginalConstructor()->getMock();
        $this->pluginMock = $this->getMockBuilder(AvailabilityAlertMigratorExpanderPluginInterface::class)->disableOriginalConstructor()->getMock();

        $this->expander = new Expander([$this->pluginMock]);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->pluginMock->expects(static::once())->method('expand')->willReturn($this->subscriptionTransferMock);
        $this->expander->expand($this->fosAvailabilityAlertSubscriptionEntityTransferMock, $this->subscriptionTransferMock);
    }
}
