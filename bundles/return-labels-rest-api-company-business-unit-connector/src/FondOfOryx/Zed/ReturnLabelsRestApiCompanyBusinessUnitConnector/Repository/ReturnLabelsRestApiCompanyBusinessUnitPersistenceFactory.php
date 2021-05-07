<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Repository;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\ReturnLabelsRestApiCompanyBusinessUnitDependencyProvider;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Mapper\CompanyBusinessUnitTransferMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Mapper\CompanyBusinessUnitTransferMapperInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class ReturnLabelsRestApiCompanyBusinessUnitPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getCompanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->get(ReturnLabelsRestApiCompanyBusinessUnitDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT_QUERY);
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Mapper\CompanyBusinessUnitTransferMapperInterface
     */
    public function createCompanyBusinessUnitTransferMapper(): CompanyBusinessUnitTransferMapperInterface
    {
        return new CompanyBusinessUnitTransferMapper();
    }
}
