<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery
     */
    public function getCompanyUnitAddressQuery(): SpyCompanyUnitAddressQuery
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS);
    }
}
