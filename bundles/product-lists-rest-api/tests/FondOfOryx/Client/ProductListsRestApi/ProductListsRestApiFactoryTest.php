<?php

namespace FondOfOryx\Client\ProductListsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\ProductListsRestApi\Zed\ProductListsRestApiStub;
use Spryker\Client\Kernel\Container;

class ProductListsRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\Dependency\Client\ProductListsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\ProductListsRestApi\ProductListsRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(ProductListsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ProductListsRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedProductListsRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductListsRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            ProductListsRestApiStub::class,
            $this->factory
                ->createProductListsRestApiStub(),
        );
    }
}
