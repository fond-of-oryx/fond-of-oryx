<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class BusinessOnBehalfRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected MockObject|BundleProxy $bundleProxyMock;

    /**
     * @var \Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfFacadeInterface|MockObject $businessOnBehalfFacadeMock;

    /**
     * @var \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUserFacadeInterface|MockObject $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiDependencyProvider
     */
    protected BusinessOnBehalfRestApiDependencyProvider $dependencyProvider;

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

        $this->businessOnBehalfFacadeMock = $this->getMockBuilder(BusinessOnBehalfFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(CompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new BusinessOnBehalfRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'businessOnBehalf':
                        return $self->bundleProxyMock;
                    case 'companyUser':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->businessOnBehalfFacadeMock,
                $this->companyUserFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface::class,
            $container[BusinessOnBehalfRestApiDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
        );

        static::assertInstanceOf(
            BusinessOnBehalfRestApiToCompanyUserFacadeInterface::class,
            $container[BusinessOnBehalfRestApiDependencyProvider::FACADE_COMPANY_USER],
        );
    }
}
