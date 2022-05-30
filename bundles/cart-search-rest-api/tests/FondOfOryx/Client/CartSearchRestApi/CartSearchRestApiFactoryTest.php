<?php

namespace FondOfOryx\Client\CartSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CartSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CartSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CartSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCartSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CartSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CartSearchRestApiStub::class,
            $this->factory->createZedCartSearchRestApiStub(),
        );
    }
}
