<?php

namespace FondOfOryx\Zed\InvoiceApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApi;
use FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

class InvoiceApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\Model\InvoiceApi
     */
    protected $invoiceApiMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\InvoiceApi\Business\Model\Validator\InvoiceApiValidator
     */
    protected $invoiceApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Business\InvoiceApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceApiMock = $this->getMockBuilder(InvoiceApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceApiValidatorMock = $this->getMockBuilder(InvoiceApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(InvoiceApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new InvoiceApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddInvoice(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceApi')
            ->willReturn($this->invoiceApiMock);

        $this->invoiceApiMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->facade->addInvoice($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createInvoiceApiValidator')
            ->willReturn($this->invoiceApiValidatorMock);

        $this->invoiceApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        static::assertEquals([], $this->facade->validate($this->apiDataTransferMock));
    }
}
