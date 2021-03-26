<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriter;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepository;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductLocaleRestrictionStorageBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageBusinessFactory
     */
    protected $productLocaleRestrictionStorageBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ProductLocaleRestrictionStorageConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageBusinessFactory = new ProductLocaleRestrictionStorageBusinessFactory();
        $this->productLocaleRestrictionStorageBusinessFactory->setContainer($this->containerMock);
        $this->productLocaleRestrictionStorageBusinessFactory->setConfig($this->configMock);
        $this->productLocaleRestrictionStorageBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractLocaleRestrictionStorageWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductLocaleRestrictionStorageDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION)
            ->willReturn($this->productLocaleRestrictionFacadeMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('isSendingToQueue')
            ->willReturn(true);

        static::assertInstanceOf(
            ProductAbstractLocaleRestrictionStorageWriter::class,
            $this->productLocaleRestrictionStorageBusinessFactory
                ->createProductAbstractLocaleRestrictionStorageWriter()
        );
    }
}
