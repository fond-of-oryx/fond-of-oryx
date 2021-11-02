<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReader;
use FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriter;
use FondOfOryx\Zed\ErpOrder\Exception\UnknownTypeException;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use ReflectionMethod;

class ErpOrderAddressHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressWriterMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Reader\ErpOrderAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Handler\ErpOrderAddressHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->addressWriterMock = $this->getMockBuilder(ErpOrderAddressWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressReaderMock = $this->getMockBuilder(ErpOrderAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderAddressTransferMock = $this->getMockBuilder(ErpOrderAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ErpOrderAddressHandler(
            $this->addressWriterMock,
            $this->addressReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressUpdate(): void
    {
        $this->erpOrderTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpOrderTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpOrderAddress')->willReturn(1);
        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpOrderAddressByIdErpOrderAddress')->willReturn($this->erpOrderAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpOrderAddressTransferMock);

        $order = $this->handler->handle($this->erpOrderTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleBillingAddressCreate(): void
    {
        $this->erpOrderTransferMock->expects($this->once())->method('setBillingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->once())->method('setFkBillingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkShippingAddress');

        $this->erpOrderTransferMock->expects($this->once())->method('getBillingAddress')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('getShippingAddress');

        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpOrderAddress')->willReturn(null);
        $this->erpOrderAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpOrderAddressTransferMock->expects($this->never())->method('toArray');

        $this->addressReaderMock->expects($this->never())->method('findErpOrderAddressByIdErpOrderAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpOrderAddressTransferMock);

        $order = $this->handler->handle($this->erpOrderTransferMock, static::BILLING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressUpdate(): void
    {
        $this->erpOrderTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpOrderTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpOrderAddress')->willReturn(1);
        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('fromArray')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('toArray')->willReturn([]);

        $this->addressReaderMock->expects($this->atLeastOnce())->method('findErpOrderAddressByIdErpOrderAddress')->willReturn($this->erpOrderAddressTransferMock);

        $this->addressWriterMock->expects($this->atLeastOnce())->method('update')->willReturn($this->erpOrderAddressTransferMock);

        $order = $this->handler->handle($this->erpOrderTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleShippingAddressCreate(): void
    {
        $this->erpOrderTransferMock->expects($this->once())->method('setShippingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->once())->method('setFkShippingAddress')->willReturn($this->erpOrderTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkBillingAddress');

        $this->erpOrderTransferMock->expects($this->once())->method('getShippingAddress')->willReturn($this->erpOrderAddressTransferMock);
        $this->erpOrderTransferMock->expects($this->never())->method('getBillingAddress');

        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpOrderAddress')->willReturn(null);
        $this->erpOrderAddressTransferMock->expects($this->never())->method('fromArray');
        $this->erpOrderAddressTransferMock->expects($this->never())->method('toArray');

        $this->addressReaderMock->expects($this->never())->method('findErpOrderAddressByIdErpOrderAddress');

        $this->addressWriterMock->expects($this->atLeastOnce())->method('create')->willReturn($this->erpOrderAddressTransferMock);

        $order = $this->handler->handle($this->erpOrderTransferMock, static::SHIPPING_ADDRESS);
    }

    /**
     * @return void
     */
    public function testHandleThrowsException(): void
    {
        $catch = null;
        try {
            $order = $this->handler->handle($this->erpOrderTransferMock, 'test');
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
        $this->erpOrderAddressTransferMock->expects($this->atLeastOnce())->method('getIdErpOrderAddress')->willReturn(1);
        $this->addressWriterMock->expects($this->never())->method('create');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('IdErpOrderAddress for create ErpOrderAddress has to be null!');
        $method = new ReflectionMethod(ErpOrderAddressHandler::class, 'create');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpOrderAddressTransferMock]);
    }

    /**
     * @return void
     */
    public function testGetAddressByTypeThrowsException(): void
    {
        $this->erpOrderTransferMock->expects($this->never())->method('getBillingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('getShippingAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpOrderAddressHandler::class, 'getAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpOrderTransferMock, 'test']);
    }

    /**
     * @return void
     */
    public function testHandleAddressByTypeThrowsException(): void
    {
        $this->erpOrderTransferMock->expects($this->never())->method('setBillingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkBillingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setShippingAddress');
        $this->erpOrderTransferMock->expects($this->never())->method('setFkShippingAddress');
        $this->erpOrderAddressTransferMock->expects($this->never())->method('getIdErpOrderAddress');

        $this->expectException(UnknownTypeException::class);
        $this->expectExceptionMessage('Type "test" not known or address is null!');
        $method = new ReflectionMethod(ErpOrderAddressHandler::class, 'handleAddressByType');
        $method->setAccessible(true);

        $method->invokeArgs($this->handler, [$this->erpOrderTransferMock, $this->erpOrderAddressTransferMock, 'test']);
    }
}
