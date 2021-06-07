<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface;
use FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStub;
use Spryker\Client\Kernel\Container;

class SplittableTotalsRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(SplittableTotalsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new SplittableTotalsRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableTotalsRestApiZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableTotalsRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            SplittableTotalsRestApiZedStub::class,
            $this->factory
                ->createSplittableTotalsRestApiZedStub()
        );
    }
}
