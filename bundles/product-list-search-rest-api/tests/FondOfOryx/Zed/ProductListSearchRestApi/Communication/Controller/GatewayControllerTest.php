<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepository;
use Generated\Shared\Transfer\ProductListCollectionTransfer;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductListSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new GatewayController();
        $this->gatewayController->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testSearchProductListAction(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('searchProductList')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        static::assertEquals(
            $this->productListCollectionTransferMock,
            $this->gatewayController->searchProductListAction($this->productListCollectionTransferMock),
        );
    }
}
