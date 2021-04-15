<?php

namespace FondOfOryx\Yves\AvailabilityAlertCrossEngage\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class CrossEngageAvailabilityAlertSubscriptionRequestExpanderPluginTest extends Unit
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionRequestMock;

    /**
     * @var \FondOfOryx\Yves\AvailabilityAlertCrossEngage\Plugin\CrossEngageAvailabilityAlertSubscriptionRequestExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->requestMock = static::getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionRequestMock = static::getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new CrossEngageAvailabilityAlertSubscriptionRequestExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandWithNoIpAddress(): void
    {
        $this->requestMock->expects(static::once())->method('getClientIps')->willReturn([]);
        $this->subscriptionRequestMock->expects(static::once())->method('setSubscriberIp')->willReturn($this->subscriptionRequestMock);

        $transfer = $this->plugin->expand($this->subscriptionRequestMock, [], $this->requestMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionRequestTransfer::class, $transfer);
    }

    /**
     * @return void
     */
    public function testExpandWithBagOfIps(): void
    {
        $self = $this;
        $ips = [
            'IP1',
            'IP2',
            'IP3',
        ];
        $this->requestMock->expects(static::once())->method('getClientIps')->willReturn($ips);
        $this->subscriptionRequestMock->expects(static::once())->method('setSubscriberIp')->willReturnCallback(
            static function ($args) use ($self) {
                static::assertSame('IP3', $args);

                return $self->subscriptionRequestMock;
            }
        );

        $transfer = $this->plugin->expand($this->subscriptionRequestMock, [], $this->requestMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionRequestTransfer::class, $transfer);
    }

    /**
     * @return void
     */
    public function testExpandWithOneIp(): void
    {
        $self = $this;
        $ips = [
            'IP1',
        ];
        $this->requestMock->expects(static::once())->method('getClientIps')->willReturn($ips);
        $this->subscriptionRequestMock->expects(static::once())->method('setSubscriberIp')->willReturnCallback(
            static function ($args) use ($self) {
                static::assertSame('IP1', $args);

                return $self->subscriptionRequestMock;
            }
        );

        $transfer = $this->plugin->expand($this->subscriptionRequestMock, [], $this->requestMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionRequestTransfer::class, $transfer);
    }

    /**
     * @return void
     */
    public function testExpandWithBagOfEmptyArray(): void
    {
        $self = $this;
        $ips = [];
        $this->requestMock->expects(static::once())->method('getClientIps')->willReturn($ips);
        $this->subscriptionRequestMock->expects(static::once())->method('setSubscriberIp')->willReturnCallback(
            static function ($args) use ($self) {
                static::assertSame(null, $args);

                return $self->subscriptionRequestMock;
            }
        );

        $transfer = $this->plugin->expand($this->subscriptionRequestMock, [], $this->requestMock);

        static::assertInstanceOf(AvailabilityAlertSubscriptionRequestTransfer::class, $transfer);
    }
}
