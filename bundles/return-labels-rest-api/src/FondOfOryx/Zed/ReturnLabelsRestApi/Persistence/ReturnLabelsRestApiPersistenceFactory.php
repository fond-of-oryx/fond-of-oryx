<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapper;
use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;

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

    /**
     * @return CompanyUnitAddressMapperInterface
     */
    public function createCompanyUnitAddressMapper(): CompanyUnitAddressMapperInterface
    {
        return new CompanyUnitAddressMapper();
    }
}
