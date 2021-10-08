<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence;

use FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\Mapper\CompanyMapper;
use FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\Mapper\CompanyMapperInterface;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiConfig getConfig()
 */
class CompanySearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(CompanySearchRestApiDependencyProvider::PROPEL_QUERY_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanySearchRestApi\Persistence\Propel\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
