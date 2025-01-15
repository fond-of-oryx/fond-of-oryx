<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ProductListsRestApi\Business\Updater\ProductListUpdater;
use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepository;
use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig;
use FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\ProductListsRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Business\ProductListsRestApiBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductListsRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListFacadeMock = $this->getMockBuilder(ProductListsRestApiToProductListFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductListsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ProductListsRestApiBusinessFactory();
        $this->factory->setConfig($this->configMock);
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListUpdater(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ProductListsRestApiDependencyProvider::FACADE_PRODUCT_LIST:
                        return $self->productListFacadeMock;
                    case ProductListsRestApiDependencyProvider::PLUGINS_PRODUCT_LIST_UPDATE_PRE_CHECK:
                        return [];
                    case ProductListsRestApiDependencyProvider::PLUGINS_PRODUCT_LIST_POST_UPDATE:
                        return [];
                    case ProductListsRestApiDependencyProvider::PLUGINS_REST_PRODUCT_LIST_UPDATE_REQUEST_EXPANDER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ProductListUpdater::class,
            $this->factory->createProductListUpdater(),
        );
    }
}
