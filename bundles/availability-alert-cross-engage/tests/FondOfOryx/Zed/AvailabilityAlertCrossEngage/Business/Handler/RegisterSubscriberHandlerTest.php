<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Monolog\Logger;

class RegisterSubscriberHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \Monolog\Logger|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\RegisterSubscriberHandler
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new RegisterSubscriberHandler($this->facadeMock, $this->loggerMock);
    }

    /**
     * @return void
     */
    public function testRegisterSubscriber(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscriber');
        $this->loggerMock->expects(static::never())->method('error');

        $transfer = $this->handler->registerSubscriber($this->subscriberTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer::class, $transfer);
        static::assertTrue($transfer->getStatus());
    }

    /**
     * @return void
     */
    public function testRegisterSubscriberWillFail(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscriber')->willThrowException(new Exception('test'));
        $this->loggerMock->expects(static::once())->method('error');

        $transfer = $this->handler->registerSubscriber($this->subscriberTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageSubscriberRegistrationResponseTransfer::class, $transfer);
        static::assertFalse($transfer->getStatus());
    }
}
