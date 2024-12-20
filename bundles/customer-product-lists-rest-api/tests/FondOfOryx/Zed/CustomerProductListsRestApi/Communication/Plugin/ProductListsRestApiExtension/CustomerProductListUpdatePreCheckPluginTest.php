<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepository;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CustomerProductListUpdatePreCheckPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Communication\Plugin\ProductListsRestApiExtension\CustomerProductListUpdatePreCheckPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerProductListUpdatePreCheckPlugin();
        $this->plugin->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testPreCheck(): void
    {
        $idProductList = 1;
        $idCustomer = 2;

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($idProductList);

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasProductListByIdProductListAndIdCustomer')
            ->with($idProductList, $idCustomer)
            ->willReturn(true);

        static::assertEquals(
            true,
            $this->plugin->preCheck($this->restProductListUpdateRequestTransferMock, $this->productListTransferMock),
        );
    }
}
