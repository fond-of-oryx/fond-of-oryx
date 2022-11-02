<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Propel\Mapper\CompanyBusinessUnitBusinessUnitMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\ReturnLabelsRestApiCompanyBusinessUnitConnectorDependencyProvider;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class ReturnLabelsRestApiCompanyBusinessUnitConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery
     */
    public function getComanyBusinessUnitQuery(): SpyCompanyBusinessUnitQuery
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiCompanyBusinessUnitConnectorDependencyProvider::PROPEL_QUERY_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\Propel\Mapper\CompanyBusinessUnitMapperInterface
     */
    public function createCompanyBusinessUnitMapper(): CompanyBusinessUnitMapperInterface
    {
        return new CompanyBusinessUnitBusinessUnitMapper();
    }
}
