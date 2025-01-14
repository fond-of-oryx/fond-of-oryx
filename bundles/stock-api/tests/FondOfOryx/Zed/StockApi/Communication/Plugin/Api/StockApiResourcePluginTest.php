<?php

namespace FondOfOryx\Zed\StockApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\StockApi\Business\StockApiFacade;
use FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer;
use FondOfOryx\Zed\StockApi\StockApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use RuntimeException;

class StockApiResourcePluginTest extends Unit
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
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer |\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiRequestTransfer;

    /**
     * @var \FondOfOryx\Zed\StockApi\Communication\Plugin\Api\StockApiResourcePlugin
     */
    protected $stockApiResourcePlugin;

    /**
     * @var \FondOfOryx\Zed\StockApi\StockApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryContainerMock;

    /**
     * @return void
     */
    public function _before(): void
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

        $this->apiRequestTransfer = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(StockApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(StockApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(StockApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->stockApiResourcePlugin = new class ($this->facadeMock, $this->configMock, $this->queryContainerMock) extends StockApiResourcePlugin {
            /**
             * @var \FondOfOryx\Zed\StockApi\StockApiConfig
             */
            protected $configMock;

            /**
             * @var \FondOfOryx\Zed\StockApi\Business\StockApiFacade
             */
            protected $facadeMock;

            /**
             * @var \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer
             */
            protected $queryContainerMock;

            /**
             * @param \FondOfOryx\Zed\StockApi\Business\StockApiFacade $stockFacade
             * @param \FondOfOryx\Zed\StockApi\StockApiConfig $config
             * @param \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer $queryContainer
             */
            public function __construct(StockApiFacade $stockFacade, StockApiConfig $config, StockApiQueryContainer $queryContainer)
            {
                $this->facadeMock = $stockFacade;
                $this->configMock = $config;
                $this->queryContainerMock = $queryContainer;
            }

            /**
             * @return \FondOfOryx\Zed\StockApi\Business\StockApiFacade
             */
            protected function getFacade(): StockApiFacade
            {
                return $this->facadeMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\AbstractBundleConfig
             */
            public function getConfig()
            {
                return $this->configMock;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer
             */
            protected function getQueryContainer()
            {
                return $this->queryContainerMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->facadeMock->expects(static::once())->method('getStockById')->willReturn($this->apiItemTransferMock);
        $this->stockApiResourcePlugin->get(1);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->add($this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->remove(1);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->facadeMock->expects(static::once())->method('findStock')->willReturn($this->apiCollectionTransferMock);
        $this->stockApiResourcePlugin->find($this->apiRequestTransfer);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->expectException(RuntimeException::class);
        $this->stockApiResourcePlugin->update(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $resource = $this->stockApiResourcePlugin->getResourceName();

        $this->assertEquals('stocks', $resource);
    }
}
