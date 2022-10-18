<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiFacade;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiFacade|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $facadeMock;

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

        $this->facadeMock = $this->getMockBuilder(ProductListSearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCollectionTransferMock = $this->getMockBuilder(ProductListCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected $productListSearchRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->productListSearchRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->productListSearchRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testFindProductListAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findProductList')
            ->with($this->productListCollectionTransferMock)
            ->willReturn($this->productListCollectionTransferMock);

        static::assertEquals(
            $this->productListCollectionTransferMock,
            $this->gatewayController->findProductListAction($this->productListCollectionTransferMock),
        );
    }
}
