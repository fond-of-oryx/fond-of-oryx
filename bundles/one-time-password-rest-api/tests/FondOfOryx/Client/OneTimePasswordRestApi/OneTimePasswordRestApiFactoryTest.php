<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientInterface;
use FondOfOryx\Client\OneTimePasswordRestApi\Zed\OneTimePasswordRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class OneTimePasswordRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiFactory
     */
    protected $oneTimePasswordRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(OneTimePasswordRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiFactory = new OneTimePasswordRestApiFactory();
        $this->oneTimePasswordRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetZedRequestClient(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(OneTimePasswordRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        $this->assertInstanceOf(
            OneTimePasswordRestApiStubInterface::class,
            $this->oneTimePasswordRestApiFactory->createOneTimePasswordZedStub()
        );
    }
}
