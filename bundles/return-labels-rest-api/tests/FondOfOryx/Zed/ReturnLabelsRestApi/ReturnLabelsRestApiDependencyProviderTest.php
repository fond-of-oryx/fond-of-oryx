<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacade;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ReturnLabelsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelFacadeMock = $this->getMockBuilder(ReturnLabelFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new ReturnLabelsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['returnLabel'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'])
            ->willReturnOnConsecutiveCalls($this->returnLabelFacadeMock);

        $container = $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock);

        static::assertInstanceOf(
            ReturnLabelsRestApiToReturnLabelFacadeInterface::class,
            $container->get(ReturnLabelsRestApiDependencyProvider::FACADE_RETURN_LABEL)
        );

        static::assertCount(
            0,
            $container->get(ReturnLabelsRestApiDependencyProvider::PLUGINS_RETURN_LABEL_REQUEST_EXPANDER)
        );
    }
}
