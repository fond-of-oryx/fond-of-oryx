<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiFacade;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CustomerProductListPostUpdatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension\CustomerProductListPostUpdatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerProductListsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerProductListPostUpdatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostUpdate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCustomerProductListRelation')
            ->with(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            );

        static::assertEquals(
            $this->productListTransferMock,
            $this->plugin->postUpdate($this->restProductListUpdateRequestTransferMock, $this->productListTransferMock),
        );
    }
}
