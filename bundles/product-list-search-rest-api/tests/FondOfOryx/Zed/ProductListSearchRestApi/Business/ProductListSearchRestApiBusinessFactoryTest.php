<?php

namespace FondOfOryx\Zed\ProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListSearchRestApi\Business\Reader\ProductListReader;
use FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepository;
use FondOfOryx\Zed\ProductListSearchRestApi\ProductListSearchRestApiDependencyProvider;
use FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class ProductListSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\ProductListSearchRestApi\Persistence\ProductListSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ProductListSearchRestApiRepository $repositoryMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|(\FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchProductListQueryExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)>
     */
    protected array $searchProductListQueryExpanderPluginMocks;

    /**
     * @var \FondOfOryx\Zed\ProductListSearchRestApi\Business\ProductListSearchRestApiBusinessFactory
     */
    protected ProductListSearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductListSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchProductListQueryExpanderPluginMocks = [
            $this->getMockBuilder(SearchProductListQueryExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->factory = new ProductListSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ProductListSearchRestApiDependencyProvider::PLUGINS_SEARCH_PRODUCT_LIST_QUERY_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductListSearchRestApiDependencyProvider::PLUGINS_SEARCH_PRODUCT_LIST_QUERY_EXPANDER)
            ->willReturn($this->searchProductListQueryExpanderPluginMocks);

        static::assertInstanceOf(
            ProductListReader::class,
            $this->factory->createProductListReader(),
        );
    }
}
