<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanyProductListSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyProductListSearchRestApiRepository $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyProductListSearchRestApiToPermissionFacadeInterface|MockObject $permissionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\CompanyProductListSearchRestApiBusinessFactory
     */
    protected CompanyProductListSearchRestApiBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyProductListSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyProductListSearchRestApiToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyProductListSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchProductListQueryExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyProductListSearchRestApiDependencyProvider::FACADE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyProductListSearchRestApiDependencyProvider::FACADE_PERMISSION)
            ->willReturn($this->permissionFacadeMock);

        static::assertInstanceOf(
            SearchProductListQueryExpander::class,
            $this->factory->createSearchProductListQueryExpander(),
        );
    }
}
