<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiFacade;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Generated\Shared\Transfer\RestProductListUpdateResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ProductListsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateResponseTransferMock = $this->getMockBuilder(RestProductListUpdateResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
        /**
         * @var \Spryker\Zed\Kernel\Business\AbstractFacade
         */
            protected $productListsRestApiFacade;

        /**
         * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
         */
            public function __construct(AbstractFacade $facade)
            {
                $this->productListsRestApiFacade = $facade;
            }

        /**
         * @return \Spryker\Zed\Kernel\Business\AbstractFacade
         */
            protected function getFacade(): AbstractFacade
            {
                return $this->productListsRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testSearchProductListAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateProductListByRestProductListUpdateRequest')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateResponseTransferMock);

        static::assertEquals(
            $this->restProductListUpdateResponseTransferMock,
            $this->gatewayController->updateProductListByRestProductListUpdateRequestAction(
                $this->restProductListUpdateRequestTransferMock,
            ),
        );
    }
}
