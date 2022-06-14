<?php

namespace FondOfOryx\Zed\ProductListApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListApi\Business\ProductListApiFacade;
use FondOfOryx\Zed\ProductListApi\ProductListApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;

class ProductListApiResourcePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiFacade|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Communication\Plugin\Api\CustomerProductListApiResourcePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ProductListApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductListApiResourcePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        static::expectException(RuntimeException::class);

        $this->plugin->get(1);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        static::expectException(RuntimeException::class);

        $this->plugin->update(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        static::expectException(RuntimeException::class);

        $this->plugin->add($this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        static::expectException(RuntimeException::class);

        $this->plugin->remove(1);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findProductLists')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertInstanceOf(
            ApiCollectionTransfer::class,
            $this->plugin->find($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetResourcename(): void
    {
        static::assertEquals(
            ProductListApiConfig::RESOURCE_PRODUCT_LIST,
            $this->plugin->getResourceName(),
        );
    }
}
