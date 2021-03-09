<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface;
use Spryker\Client\Kernel\Container;

class SplittableCheckoutRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory
     */
    protected $splittableCheckoutRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

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

        $this->splittableCheckoutRestApiFactory = new SplittableCheckoutRestApiFactory();
        $this->splittableCheckoutRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutRestApiZedStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(SplittableCheckoutRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        $this->assertInstanceOf(
            SplittableCheckoutRestApiZedStubInterface::class,
            $this->splittableCheckoutRestApiFactory->createSplittableCheckoutRestApiZedStub()
        );
    }
}
