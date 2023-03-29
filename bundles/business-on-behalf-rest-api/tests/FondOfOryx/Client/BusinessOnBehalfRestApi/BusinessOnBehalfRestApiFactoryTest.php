<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStub;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\Container;

class BusinessOnBehalfRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiToZedRequestClientInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory
     */
    protected BusinessOnBehalfRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(BusinessOnBehalfRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new BusinessOnBehalfRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateBusinessOnBehalfRestApiZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(BusinessOnBehalfRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            BusinessOnBehalfRestApiZedStub::class,
            $this->factory
                ->createBusinessOnBehalfRestApiZedStub(),
        );
    }
}
