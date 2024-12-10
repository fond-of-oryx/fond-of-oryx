<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapper;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery;
use Spryker\Zed\Kernel\Container;

class CompanyRoleSearchRestApiPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiPersistenceFactory;
     */
    protected $companyRoleSearchRestApiPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleQuery
     */
    protected $spyCompanyRoleQuery;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyRoleQuery = $this->getMockBuilder(SpyCompanyRoleQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleSearchRestApiPersistenceFactory = new CompanyRoleSearchRestApiPersistenceFactory();
        $this->companyRoleSearchRestApiPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyRoleMapper(): void
    {
        static::assertInstanceOf(
            CompanyRoleMapper::class,
            $this->companyRoleSearchRestApiPersistenceFactory->createCompanyRoleMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyRoleQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyRoleSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyRoleSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE)
            ->willReturn($this->spyCompanyRoleQuery);

        static::assertInstanceOf(
            SpyCompanyRoleQuery::class,
            $this->companyRoleSearchRestApiPersistenceFactory->getCompanyRoleQuery(),
        );
    }
}
