<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\Propel\Mapper\CompanyMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\Propel\Mapper\CompanyMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\ReturnLabelsRestApiCompanyConnectorDependencyProvider;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class ReturnLabelsRestApiCompanyConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(
            ReturnLabelsRestApiCompanyConnectorDependencyProvider::PROPEL_QUERY_COMPANY,
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\Propel\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
