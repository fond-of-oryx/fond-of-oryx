<?php

namespace FondOfOryx\Zed\StockApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\Model\StockApi;
use FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class StockApiFacadeTest extends Unit
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
     * @var \FondOfOryx\Zed\StockApi\Business\Model\StockApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidator|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiBusinessFactory |\PHPUnit\Framework\MockObject\MockObject
     */
    protected $stockApiBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacade
     */
    protected $stockApiFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
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

        $this->stockApiMock = $this->getMockBuilder(StockApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiBusinessFactoryMock = $this->getMockBuilder(StockApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiValidatorMock = $this->getMockBuilder(StockApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiFacade = new StockApiFacade();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->stockApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createStockApiValidator')
            ->willReturn($this->stockApiValidatorMock);

        $this->stockApiValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn([]);

        $this->stockApiFacade->setFactory($this->stockApiBusinessFactoryMock);
        $errors = $this->stockApiFacade->validate($this->apiRequestTransferMock);

        $this->assertIsArray($errors);
    }

    /**
     * @return void
     */
    public function testFindStock(): void
    {
        $this->stockApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createStockApi')
            ->willReturn($this->stockApiMock);

        $this->stockApiMock->expects($this->atLeastOnce())
            ->method('find')
            ->willReturn($this->apiCollectionTransferMock);

        $this->stockApiFacade->setFactory($this->stockApiBusinessFactoryMock);

        $this->stockApiFacade->findStock($this->apiRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testGetStockById(): void
    {
        $this->stockApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createStockApi')
            ->willReturn($this->stockApiMock);

        $this->stockApiMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn($this->apiItemTransferMock);

        $this->stockApiFacade->setFactory($this->stockApiBusinessFactoryMock);

        $this->stockApiFacade->getStockById(1);
    }
}
