<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Notification;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class CrossEngageNotificationPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Notification\CrossEngageNotificationPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = static::getMockBuilder(AvailabilityAlertCrossEngageFacade::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->facadeMock) extends CrossEngageNotificationPlugin {
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
        $this->facadeMock->expects(static::once())->method('sendNotification');
        $this->plugin->notify($this->subscriptionTransferMock);
    }
}
