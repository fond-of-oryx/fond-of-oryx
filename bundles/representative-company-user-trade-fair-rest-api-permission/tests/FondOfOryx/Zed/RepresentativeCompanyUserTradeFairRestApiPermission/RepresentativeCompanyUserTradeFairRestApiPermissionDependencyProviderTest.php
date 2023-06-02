<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission;

use Codeception\Test\Unit;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
use Spryker\Zed\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider
     */
    protected RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet', 'has', 'offsetExists'])
            ->getMock();

        $this->dependencyProvider = new RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $container = $this->dependencyProvider->providePersistenceLayerDependencies($this->containerMock);

        static::assertInstanceOf(
            SpyCompanyRoleToPermissionQuery::class,
            $container[RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider::QUERY_SPY_COMPANY_ROLE_PERMISSION],
        );

    }
}
