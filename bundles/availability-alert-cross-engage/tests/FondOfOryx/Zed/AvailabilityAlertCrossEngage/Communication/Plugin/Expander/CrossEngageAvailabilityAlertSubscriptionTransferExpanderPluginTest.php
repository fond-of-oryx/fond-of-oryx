<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CrossEngageAvailabilityAlertSubscriptionTransferExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $crossEngageServiceMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Expander\CrossEngageAvailabilityAlertSubscriptionTransferExpanderPlugin
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = static::getMockBuilder(AvailabilityAlertCrossEngageFacade::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = static::getMockBuilder(AvailabilityAlertCrossEngageCommunicationFactory::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = static::getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionRequestTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->crossEngageServiceMock = static::getMockBuilder(AvailabilityAlertCrossEngageToCrossEngageServiceBridge::class)->disableOriginalConstructor()->getMock();

        $this->expander = new class ($this->facadeMock, $this->factoryMock) extends CrossEngageAvailabilityAlertSubscriptionTransferExpanderPlugin {
            /**
             * @var \Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory
             */
            protected $factoryOwn;

            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $facadeOwn;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade $facade
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory $factory
             */
            public function __construct(
                AvailabilityAlertCrossEngageFacade $facade,
                AvailabilityAlertCrossEngageCommunicationFactory $factory
            ) {
                $this->factoryOwn = $factory;
                $this->facadeOwn = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->facadeOwn;
            }

            /**
             * @return \Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory
             */
            protected function getFactory(): AbstractCommunicationFactory
            {
                return $this->factoryOwn;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::once())->method('generateKey')->willReturn('');
        $this->factoryMock->expects(static::once())->method('getCrossEngageService')->willReturn($this->crossEngageServiceMock);
        $this->crossEngageServiceMock->expects(static::once())->method('getHash')->willReturn('');
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('test@test.de');
        $this->subscriberTransferMock->expects(static::once())->method('setSubscriberIp')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setKey')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setHash')->willReturn($this->subscriberTransferMock);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('getSubscriberIp')->willReturn('');
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSubscriber')->willReturn($this->subscriptionTransferMock);

        $transfer = $this->expander->expand($this->subscriptionTransferMock, $this->subscriptionRequestTransferMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionTransfer::class, $transfer);
    }
}
