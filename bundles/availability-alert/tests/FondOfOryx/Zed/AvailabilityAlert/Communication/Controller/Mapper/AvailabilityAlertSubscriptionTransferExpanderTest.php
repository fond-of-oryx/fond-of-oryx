<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionTransferExpanderPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertSubscriptionTransferExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

   /**
    * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
    */
    protected $subscriptionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionTransferExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginMock;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->pluginMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransferExpanderPluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionRequestTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * @return void
     */
    public function testExpandWithSubscriptionRequest(): void
    {
        $this->pluginMock->expects(static::exactly(2))->method('expand')->willReturn($this->subscriptionTransferMock);
        $expander = new AvailabilityAlertSubscriptionTransferExpander([$this->pluginMock, $this->pluginMock]);
        $response = $expander->expandWithSubscriptionRequest($this->subscriptionTransferMock, $this->subscriptionRequestTransferMock);
        static::assertInstanceOf(AvailabilityAlertSubscriptionTransfer::class, $response);
    }
}
