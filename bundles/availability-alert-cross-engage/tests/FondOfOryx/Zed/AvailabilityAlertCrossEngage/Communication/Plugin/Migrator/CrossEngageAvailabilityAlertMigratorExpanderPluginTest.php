<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Migrator\CrossEngageAvailabilityAlertMigratorExpanderPlugin;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CrossEngageAvailabilityAlertMigratorExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Service\AvailabilityAlertCrossEngageToCrossEngageServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $crossEngageServiceMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fosAvailabilityAlertSubscriptionEntityTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Migrator\CrossEngageAvailabilityAlertMigratorExpanderPlugin
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
        $this->crossEngageServiceMock = $this->getMockBuilder(AvailabilityAlertCrossEngageToCrossEngageServiceBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->fosAvailabilityAlertSubscriptionEntityTransferMock = $this->getMockBuilder(FosAvailabilityAlertSubscriptionEntityTransfer::class)->disableOriginalConstructor()->getMock();

        $this->expander = new class ($this->facadeMock, $this->factoryMock) extends CrossEngageAvailabilityAlertMigratorExpanderPlugin {
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
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriptionTransferMock->expects(static::once())->method('setSubscriber')->willReturn($this->subscriptionTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setSubscriberIp')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setKey')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('setHash')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::exactly(2))->method('getEmail')->willReturn('info@test.com');
        $this->facadeMock->expects(static::once())->method('generateKey')->willReturn('key');
        $this->factoryMock->expects(static::once())->method('getCrossEngageService')->willReturn($this->crossEngageServiceMock);
        $this->crossEngageServiceMock->expects(static::once())->method('getHash')->willReturn('hash');

        $this->expander->expand(
            $this->fosAvailabilityAlertSubscriptionEntityTransferMock,
            $this->subscriptionTransferMock
        );
    }

    /**
     * @return void
     */
    public function testExpandWithMissingSubscriber(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber');

        $this->subscriptionTransferMock->expects(static::never())->method('setSubscriber');
        $this->subscriberTransferMock->expects(static::never())->method('setSubscriberIp');
        $this->subscriberTransferMock->expects(static::never())->method('setKey');
        $this->subscriberTransferMock->expects(static::never())->method('setHash');
        $this->subscriberTransferMock->expects(static::never())->method('getEmail');
        $this->facadeMock->expects(static::never())->method('generateKey');
        $this->factoryMock->expects(static::never())->method('getCrossEngageService');
        $this->crossEngageServiceMock->expects(static::never())->method('getHash');

        $exception = null;

        try {
            $this->expander->expand(
                $this->fosAvailabilityAlertSubscriptionEntityTransferMock,
                $this->subscriptionTransferMock
            );
        } catch (Exception $e) {
            $exception = $e;
        }

        static::assertNotNull($exception);
    }
}
