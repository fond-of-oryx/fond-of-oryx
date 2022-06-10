<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiFacade;
use FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;

class CustomerProductListApiResourcePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

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

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CustomerProductListApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerProductListApiResourcePlugin();
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
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addCustomerProductList')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->plugin->add($this->apiDataTransferMock),
        );
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
        static::expectException(RuntimeException::class);

        $this->plugin->find($this->apiRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testGetResourcename(): void
    {
        static::assertEquals(
            CustomerProductListApiConfig::RESOURCE_CUSTOMER_PRODUCT_LIST,
            $this->plugin->getResourceName($this->apiRequestTransferMock),
        );
    }
}
