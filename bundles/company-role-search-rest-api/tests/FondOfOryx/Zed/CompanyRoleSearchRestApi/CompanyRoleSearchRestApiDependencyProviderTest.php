<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Container;

class CompanyRoleSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected $spyCompanyRoleQueryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyRoleQueryMock = $this->getMockBuilder(SpyCompanyRoleQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new CompanyRoleSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->dependencyProvider->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($container, $this->containerMock);
    }
}
