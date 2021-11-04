<?php

namespace FondOfOryx\Zed\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\CompanyRoleSearchRestApiPersistenceFactory;
use FondOfOryx\Zed\CompanyRoleSearchRestApi\Persistence\Propel\Mapper\CompanyRoleMapperInterface;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $fooErpOrderPageSearchQueryMock;

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
    public function testCreateCompanyRoleMapper()
    {
        $this->assertInstanceOf(
            CompanyRoleMapperInterface::class,
            $this->companyRoleSearchRestApiPersistenceFactory->createCompanyRoleMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyRoleQuery()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyRoleSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyRoleSearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY_ROLE)
            ->willReturn($this->spyCompanyRoleQuery);

        $this->assertInstanceOf(
            SpyCompanyRoleQuery::class,
            $this->companyRoleSearchRestApiPersistenceFactory->getCompanyRoleQuery(),
        );
    }
}
