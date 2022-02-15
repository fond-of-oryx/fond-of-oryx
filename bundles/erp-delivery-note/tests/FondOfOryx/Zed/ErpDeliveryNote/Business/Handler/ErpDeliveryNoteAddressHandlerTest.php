<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use ReflectionMethod;

class ErpDeliveryNoteAddressHandlerTest extends Unit
{
    /**
     * @var string
     */
    protected const BILLING_ADDRESS = 'billingAddress';

    /**
     * @var string
     */
    protected const SHIPPING_ADDRESS = 'shippingAddress';

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->addressWriterMock = $this->getMockBuilder(ErpDeliveryNoteAddressWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressReaderMock = $this->getMockBuilder(ErpDeliveryNoteAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteAddressTransferMock = $this->getMockBuilder(ErpDeliveryNoteAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpDeliveryNoteAddressHandler(
            $this->addressWriterMock,
            $this->addressReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressUpdate(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteAddress')->willReturn(1);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('modifiedToArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressCreate(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteAddress')->willReturn(null);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpDeliveryNoteAddressTransferMock->expects($this->never())->method('modifiedToArray');

        $this->addressReaderMock->expects($this->never())->method('findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressUpdate(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteAddress')->willReturn(1);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('modifiedToArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressCreate(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpDeliveryNoteTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpDeliveryNoteTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpDeliveryNoteAddressTransferMock);
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteAddress')->willReturn(null);
        $this->erpDeliveryNoteAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpDeliveryNoteAddressTransferMock->expects($this->never())->method('toArray');

        $this->addressReaderMock->expects($this->never())->method('findErpDeliveryNoteAddressByIdErpDeliveryNoteAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpDeliveryNoteAddressTransferMock);

        $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleThrowsException(): void
    {
        $catch = null;
        try {
            $deliveryNote = $this->handler->handle($this->erpDeliveryNoteTransferMock, 'test');
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(UnknownTypeException::class, $catch);
    }

    /**
     * @return void
     */
    public function testCreateThrowsException(): void
    {
        $this->erpDeliveryNoteAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpDeliveryNoteAddress')->willReturn(1);
        $this->addressWriterMock->expects($this->never())->method('create');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('IdErpDeliveryNoteAddress for create ErpDeliveryNoteAddress has to be null!');
        $method = new ReflectionMethod(ErpDeliveryNoteAddressHandler::class, 'create');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpDeliveryNoteAddressTransferMock]);
    }

    /**
     * @return void
     */
    public function testGetAddressByTypeThrowsException(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getBillingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('getShippingAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpDeliveryNoteAddressHandler::class, 'getAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpDeliveryNoteTransferMock, 'test']);
    }

    /**
     * @return void
     */
    public function testHandleAddressByTypeThrowsException(): void
    {
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkBillingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpDeliveryNoteTransferMock->expects($this->never())->method('setFkShippingAddress');
        $this->erpDeliveryNoteAddressTransferMock->expects($this->never())->method('getIdErpDeliveryNoteAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpDeliveryNoteAddressHandler::class, 'handleAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpDeliveryNoteTransferMock, $this->erpDeliveryNoteAddressTransferMock, 'test']);
    }
}
