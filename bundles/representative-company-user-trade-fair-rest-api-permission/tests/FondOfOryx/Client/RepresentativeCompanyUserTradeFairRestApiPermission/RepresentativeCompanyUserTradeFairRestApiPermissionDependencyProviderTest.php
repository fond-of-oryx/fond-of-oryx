<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected  MockObject|\Spryker\Client\Kernel\Container $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Locator
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected MockObject|BundleProxy $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected ZedRequestClientInterface|MockObject $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider
     */
    protected RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(\Spryker\Client\Kernel\Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('zedRequest')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturn($this->zedRequestClientMock);

        $container = $this->dependencyProvider->provideServiceLayerDependencies($this->containerMock);

        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface::class,
            $container[RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST],
        );

    }
}
