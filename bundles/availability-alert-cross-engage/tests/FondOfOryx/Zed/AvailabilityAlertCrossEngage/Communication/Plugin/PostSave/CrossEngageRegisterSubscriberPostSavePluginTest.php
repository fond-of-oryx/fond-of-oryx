<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

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
        $this->facadeMock->expects(static::once())->method('registerSubscriber')->willReturn($this->responseTransferMock);
        $this->responseTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $response = $this->plugin->postSave($this->subscriberTransferMock);

        static::assertInstanceOf(AvailabilityAlertSubscriberTransfer::class, $response);
    }
}
