<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Persistence;

use FondOfOryx\Zed\CompanyCompanyUserGui\CompanyCompanyUserGuiDependencyProvider;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\Mapper\CompanyMapper;
use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\Mapper\CompanyMapperInterface;
use Orm\Zed\Company\Persistence\Base\SpyCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyCompanyUserGui\CompanyCompanyUserGuiConfig getConfig()
 */
class CompanyCompanyUserGuiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Company\Persistence\Base\SpyCompanyQuery
     */
    public function getCompanyQuery(): SpyCompanyQuery
    {
        return $this->getProvidedDependency(CompanyCompanyUserGuiDependencyProvider::PROPEL_QUERY_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\Mapper\CompanyMapperInterface
     */
    public function createCompanyMapper(): CompanyMapperInterface
    {
        return new CompanyMapper();
    }
}
