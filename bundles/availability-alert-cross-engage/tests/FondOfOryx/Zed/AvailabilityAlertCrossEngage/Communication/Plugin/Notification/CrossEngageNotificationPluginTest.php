<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Notification;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacade;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

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
        $this->facadeMock->expects(static::once())->method('sendNotification');
        $this->plugin->notify($this->subscriptionTransferMock);
    }
}
