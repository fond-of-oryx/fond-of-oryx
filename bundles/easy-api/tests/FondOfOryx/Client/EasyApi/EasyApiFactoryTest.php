<?php

namespace FondOfOryx\Client\EasyApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface;
use FondOfOryx\Client\EasyApi\Zed\EasyApiZedStub;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\Container;

class EasyApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|EasyApiToZedRequestClientInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\EasyApi\EasyApiFactory
     */
    protected EasyApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(EasyApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new EasyApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateEasyApiZedStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(EasyApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            EasyApiZedStub::class,
            $this->factory
                ->createEasyApiZedStub(),
        );
    }
}
