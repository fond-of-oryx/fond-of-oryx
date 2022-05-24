<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssigner;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductDefaultCategoryAssignerBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerBusinessFactory
     */
    protected $productDefaultCategoryAssignerBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ProductDefaultCategoryAssignerConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductDefaultCategoryAssignerToProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productDefaultCategoryAssignerBusinessFactory = new ProductDefaultCategoryAssignerBusinessFactory();
        $this->productDefaultCategoryAssignerBusinessFactory->setConfig($this->configMock);
        $this->productDefaultCategoryAssignerBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateDefaultCategoryAssigner(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerDependencyProvider::FACADE_PRODUCT_CATEGORY)
            ->willReturn($this->productCategoryFacadeMock);

        $defaultCategoryAssigner = $this->productDefaultCategoryAssignerBusinessFactory->createDefaultCategoryAssigner();

        static::assertInstanceOf(DefaultCategoryAssigner::class, $defaultCategoryAssigner);
    }
}
