<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

class CrossEngageRegisterSubscriberPostSavePluginTest extends Unit
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
     * @var \Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave\CrossEngageRegisterSubscriberPostSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = static::getMockBuilder(AvailabilityAlertCrossEngageFacade::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = static::getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();
        $this->responseTransferMock = static::getMockBuilder(AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->facadeMock) extends CrossEngageRegisterSubscriberPostSavePlugin {
            /**
             * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface
             */
            protected $facade;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface $facade
             */
            public function __construct(
                AvailabilityAlertCrossEngageFacadeInterface $facade
            ) {
                $this->facade = $facade;
            }

            /**
             * @return \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface
             */
            public function getFacade(): AvailabilityAlertCrossEngageFacadeInterface
            {
                return $this->facade;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::once())->method('registerSubscriber')->willReturn($this->responseTransferMock);
        $this->responseTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $response = $this->plugin->postSave($this->subscriberTransferMock);

        static::assertInstanceOf(AvailabilityAlertSubscriberTransfer::class, $response);
    }
}
