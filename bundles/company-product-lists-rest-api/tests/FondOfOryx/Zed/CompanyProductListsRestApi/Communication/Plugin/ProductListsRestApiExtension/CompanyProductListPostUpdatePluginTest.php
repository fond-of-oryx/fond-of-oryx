<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiFacade;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyProductListPostUpdatePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiFacade|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension\CompanyProductListPostUpdatePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyProductListsRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyProductListPostUpdatePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostUpdate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCompanyProductListRelation')
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
