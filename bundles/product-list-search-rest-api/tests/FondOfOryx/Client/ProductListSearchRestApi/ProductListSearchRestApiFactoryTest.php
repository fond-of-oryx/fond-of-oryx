<?php

namespace FondOfOryx\Client\ProductListSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ProductListSearchRestApi\Zed\ProductListSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class ProductListSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\Dependency\Client\ProductListSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\ProductListSearchRestApi\ProductListSearchRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ProductListSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ProductListSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedProductListSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductListSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            ProductListSearchRestApiStub::class,
            $this->factory
                ->createZedProductListSearchRestApiStub(),
        );
    }
}
