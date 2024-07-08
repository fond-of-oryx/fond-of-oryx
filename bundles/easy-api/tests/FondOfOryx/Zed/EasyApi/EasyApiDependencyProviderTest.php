<?php

namespace FondOfOryx\Zed\EasyApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientBridge;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class EasyApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\EasyApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\EasyApiDependencyProvider
     */
    protected EasyApiDependencyProvider $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->configMock = $this->getMockBuilder(EasyApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new EasyApiDependencyProvider();
        $this->dependencyProvider->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getEasyApiUri')
            ->willReturn('https://test.de');

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            EasyApiToGuzzleClientBridge::class,
            $container[EasyApiDependencyProvider::CLIENT_GUZZLE],
        );
    }
}
