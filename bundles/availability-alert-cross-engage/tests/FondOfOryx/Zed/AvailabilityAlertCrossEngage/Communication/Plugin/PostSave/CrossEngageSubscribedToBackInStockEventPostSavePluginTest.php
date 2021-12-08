<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class CrossEngageSubscribedToBackInStockEventPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave\CrossEngageSubscribedToBackInStockEventPostSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(AvailabilityAlertCrossEngageFacade::class)->disableOriginalConstructor()->getMock();
        $this->responseTransferMock = $this->getMockBuilder(AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->facadeMock) extends CrossEngageSubscribedToBackInStockEventPostSavePlugin {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $facadeOwn;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade $facade
             */
            public function __construct(
                AvailabilityAlertCrossEngageFacade $facade
            ) {
                $this->facadeOwn = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facadeOwn;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::once())->method('sendSubscribedToBackInStockEvent')->willReturn($this->responseTransferMock);
        $this->responseTransferMock->expects(static::once())->method('getSubscription')->willReturn($this->subscriptionTransferMock);
        $response = $this->plugin->postSave($this->subscriptionTransferMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionTransfer::class, $response);
    }
}
