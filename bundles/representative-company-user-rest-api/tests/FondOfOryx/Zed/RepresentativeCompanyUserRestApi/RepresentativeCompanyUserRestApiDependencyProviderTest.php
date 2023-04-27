<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\BusinessOnBehalfProductListConnectorDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class RepresentativeCompanyUserRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected MockObject|Locator $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected MockObject|BundleProxy $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new RepresentativeCompanyUserRestApiDependencyProvider();
    }

    /**
     * @skip missing module
     *
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['businessOnBehalf'], ['customer'], ['productList'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'], ['facade'], ['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->businessOnBehalfFacadeMock,
                $this->customerFacadeMock,
                $this->productListFacadeMock,
            );

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            FACADE_REPRESENTATIVE_COMPANY_USER::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF],
        );

        static::assertInstanceOf(
            BusinessOnBehalfProductListConnectorToCustomerFacadeInterface::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER],
        );

        static::assertInstanceOf(
            BusinessOnBehalfProductListConnectorToProductListFacadeInterface::class,
            $container[BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST],
        );

    }
}
