<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriter;
use FondOfOryx\Zed\ErpInvoice\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use ReflectionMethod;

class ErpInvoiceAddressHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->addressWriterMock = $this->getMockBuilder(ErpInvoiceAddressWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressReaderMock = $this->getMockBuilder(ErpInvoiceAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceAddressTransferMock = $this->getMockBuilder(ErpInvoiceAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpInvoiceAddressHandler(
            $this->addressWriterMock,
            $this->addressReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressUpdate(): void
    {
        $this->erpInvoiceTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpInvoiceTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoiceAddress')->willReturn(1);
        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('modifiedToArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceAddressByIdErpInvoiceAddress')->willReturn($this->erpInvoiceAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpInvoiceAddressTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressCreate(): void
    {
        $this->erpInvoiceTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpInvoiceTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoiceAddress')->willReturn(null);
        $this->erpInvoiceAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpInvoiceAddressTransferMock->expects($this->never())->method('modifiedToArray');

        $this->addressReaderMock->expects($this->never())->method('findErpInvoiceAddressByIdErpInvoiceAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpInvoiceAddressTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressUpdate(): void
    {
        $this->erpInvoiceTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpInvoiceTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoiceAddress')->willReturn(1);
        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('modifiedToArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpInvoiceAddressByIdErpInvoiceAddress')->willReturn($this->erpInvoiceAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpInvoiceAddressTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressCreate(): void
    {
        $this->erpInvoiceTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpInvoiceTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpInvoiceTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpInvoiceAddressTransferMock);
        $this->erpInvoiceTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoiceAddress')->willReturn(null);
        $this->erpInvoiceAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpInvoiceAddressTransferMock->expects($this->never())->method('toArray');

        $this->addressReaderMock->expects($this->never())->method('findErpInvoiceAddressByIdErpInvoiceAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpInvoiceAddressTransferMock);

        $invoice = $this->handler->handle($this->erpInvoiceTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleThrowsException(): void
    {
        $catch = null;
        try {
            $invoice = $this->handler->handle($this->erpInvoiceTransferMock, 'test');
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
        $this->erpInvoiceAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpInvoiceAddress')->willReturn(1);
        $this->addressWriterMock->expects($this->never())->method('create');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('IdErpInvoiceAddress for create ErpInvoiceAddress has to be null!');
        $method = new ReflectionMethod(ErpInvoiceAddressHandler::class, 'create');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpInvoiceAddressTransferMock]);
    }

    /**
     * @return void
     */
    public function testGetAddressByTypeThrowsException(): void
    {
        $this->erpInvoiceTransferMock->expects($this->never())->method('getBillingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('getShippingAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpInvoiceAddressHandler::class, 'getAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpInvoiceTransferMock, 'test']);
    }

    /**
     * @return void
     */
    public function testHandleAddressByTypeThrowsException(): void
    {
        $this->erpInvoiceTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkBillingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpInvoiceTransferMock->expects($this->never())->method('setFkShippingAddress');
        $this->erpInvoiceAddressTransferMock->expects($this->never())->method('getIdErpInvoiceAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpInvoiceAddressHandler::class, 'handleAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpInvoiceTransferMock, $this->erpInvoiceAddressTransferMock, 'test']);
    }
}
