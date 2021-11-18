<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApiInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpInvoiceApiFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceApiMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceApiBusinessFactoryMock;

    /**
     * @var int
     */
    protected $idErpInvoice;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiFacade
     */
    protected $erpInvoiceApiFacade;

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

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiMock = $this->getMockBuilder(ErpInvoiceApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiValidatorMock = $this->getMockBuilder(ErpInvoiceApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiBusinessFactoryMock = $this->getMockBuilder(ErpInvoiceApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idErpInvoice = 1;

        $this->erpInvoiceApiFacade = new ErpInvoiceApiFacade();
        $this->erpInvoiceApiFacade->setFactory($this->erpInvoiceApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoice(): void
    {
        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApi')
            ->willReturn($this->erpInvoiceApiMock);

        $this->erpInvoiceApiMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiFacade->createErpInvoice($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpInvoice(): void
    {
        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApi')
            ->willReturn($this->erpInvoiceApiMock);

        $this->erpInvoiceApiMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->idErpInvoice, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiFacade->updateErpInvoice($this->idErpInvoice, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetErpInvoice(): void
    {
        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApi')
            ->willReturn($this->erpInvoiceApiMock);

        $this->erpInvoiceApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiFacade->getErpInvoice($this->idErpInvoice),
        );
    }

    /**
     * @return void
     */
    public function testFindErpInvoices(): void
    {
        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApi')
            ->willReturn($this->erpInvoiceApiMock);

        $this->erpInvoiceApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpInvoiceApiFacade->findErpInvoices($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpInvoice(): void
    {
        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApi')
            ->willReturn($this->erpInvoiceApiMock);

        $this->erpInvoiceApiMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApiFacade->deleteErpInvoice($this->idErpInvoice),
        );
    }

    /**
     * @return void
     */
    public function testValidateErpInvoice(): void
    {
        $validationResult = [];

        $this->erpInvoiceApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpInvoiceApiValidator')
            ->willReturn($this->erpInvoiceApiValidatorMock);

        $this->erpInvoiceApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpInvoiceApiFacade->validateErpInvoice($this->apiDataTransferMock),
        );
    }
}
