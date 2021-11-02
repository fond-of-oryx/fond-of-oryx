<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStub;
use Spryker\Client\Kernel\Container;

class SplittableCheckoutRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(SplittableCheckoutRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new SplittableCheckoutRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutRestApiZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableCheckoutRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            SplittableCheckoutRestApiZedStub::class,
            $this->factory
                ->createSplittableCheckoutRestApiZedStub(),
        );
    }
}
