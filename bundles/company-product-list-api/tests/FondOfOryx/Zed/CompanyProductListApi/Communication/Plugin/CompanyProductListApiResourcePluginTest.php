<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListApi\Business\CompanyProductListApiFacade;
use FondOfOryx\Zed\CompanyProductListApi\CompanyProductListApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;

class CompanyProductListApiResourcePluginTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyProductListApi\Business\CompanyProductListApiFacade|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Communication\Plugin\Api\CompanyProductListApiResourcePlugin
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

        $this->facadeMock = $this->getMockBuilder(CompanyProductListApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyProductListApiResourcePlugin();
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
            ->method('addCompanyProductList')
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
            CompanyProductListApiConfig::RESOURCE_COMPANY_PRODUCT_LIST,
            $this->plugin->getResourceName($this->apiRequestTransferMock),
        );
    }
}
