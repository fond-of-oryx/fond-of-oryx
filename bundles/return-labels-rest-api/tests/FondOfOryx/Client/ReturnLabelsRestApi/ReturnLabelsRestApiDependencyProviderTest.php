<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client\ReturnLabelsRestApiToZedRequestClientInterface;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\ZedRequest\ZedRequestClient;
use Spryker\Shared\Kernel\BundleProxy;

class ReturnLabelsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new ReturnLabelsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'zedRequest':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturnOnConsecutiveCalls(
                $this->zedRequestClientMock,
            );

        $container = $this->dependencyProvider->provideServiceLayerDependencies($this->containerMock);

        static::assertInstanceOf(
            ReturnLabelsRestApiToZedRequestClientInterface::class,
            $container->get(ReturnLabelsRestApiDependencyProvider::CLIENT_ZED_REQUEST),
        );
    }
}
