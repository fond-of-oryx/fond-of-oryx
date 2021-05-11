<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;
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
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

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

        $this->facadeMock = $this->getMockBuilder(AvailabilityAlertCrossEngageFacade::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(AvailabilityAlertCrossEngageCommunicationFactory::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(AvailabilityAlertCrossEngageConfig::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionRequestTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->crossEngageServiceMock = $this->getMockBuilder(AvailabilityAlertCrossEngageToCrossEngageServiceBridge::class)->disableOriginalConstructor()->getMock();

        $this->expander = new class ($this->facadeMock, $this->factoryMock, $this->configMock) extends CrossEngageAvailabilityAlertSubscriptionTransferExpanderPlugin {
            /**
             * @var \Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory
             */
            protected $factoryOwn;

            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $facadeOwn;

            /**
             * @var \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            protected $configOwn;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade $facade
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory $factory
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig $config
             */
            public function __construct(
                AvailabilityAlertCrossEngageFacade $facade,
                AvailabilityAlertCrossEngageCommunicationFactory $factory,
                AvailabilityAlertCrossEngageConfig $config
            ) {
                $this->factoryOwn = $factory;
                $this->facadeOwn = $facade;
                $this->configOwn = $config;
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

            /**
             * @return \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            public function getConfig(): AbstractBundleConfig
            {
                return $this->configOwn;
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
        $this->subscriberTransferMock->expects(static::once())->method('setIsActive')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setKey')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setHash')->willReturn($this->subscriberTransferMock);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('getSubscriberIp')->willReturn('');
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSubscriber')->willReturn($this->subscriptionTransferMock);

        $transfer = $this->expander->expand($this->subscriptionTransferMock, $this->subscriptionRequestTransferMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionTransfer::class, $transfer);
    }
}
