<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApiInterface;
use FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpOrderApiFacadeTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderApiMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidatorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderApiBusinessFactoryMock;

    /**
     * @var int
     */
    protected $idErpOrder;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacade
     */
    protected $erpOrderApiFacade;

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

        $this->erpOrderApiMock = $this->getMockBuilder(ErpOrderApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiValidatorMock = $this->getMockBuilder(ErpOrderApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiBusinessFactoryMock = $this->getMockBuilder(ErpOrderApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idErpOrder = 1;

        $this->erpOrderApiFacade = new ErpOrderApiFacade();
        $this->erpOrderApiFacade->setFactory($this->erpOrderApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpOrder(): void
    {
        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApi')
            ->willReturn($this->erpOrderApiMock);

        $this->erpOrderApiMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiFacade->createErpOrder($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateErpOrder(): void
    {
        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApi')
            ->willReturn($this->erpOrderApiMock);

        $this->erpOrderApiMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->idErpOrder, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiFacade->updateErpOrder($this->idErpOrder, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetErpOrder(): void
    {
        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApi')
            ->willReturn($this->erpOrderApiMock);

        $this->erpOrderApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiFacade->getErpOrder($this->idErpOrder),
        );
    }

    /**
     * @return void
     */
    public function testFindErpOrders(): void
    {
        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApi')
            ->willReturn($this->erpOrderApiMock);

        $this->erpOrderApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpOrderApiFacade->findErpOrders($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteErpOrder(): void
    {
        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApi')
            ->willReturn($this->erpOrderApiMock);

        $this->erpOrderApiMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiFacade->deleteErpOrder($this->idErpOrder),
        );
    }

    /**
     * @return void
     */
    public function testValidateErpOrder(): void
    {
        $validationResult = [];

        $this->erpOrderApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createErpOrderApiValidator')
            ->willReturn($this->erpOrderApiValidatorMock);

        $this->erpOrderApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn($validationResult);

        static::assertEquals(
            $validationResult,
            $this->erpOrderApiFacade->validateErpOrder($this->apiDataTransferMock),
        );
    }
}
