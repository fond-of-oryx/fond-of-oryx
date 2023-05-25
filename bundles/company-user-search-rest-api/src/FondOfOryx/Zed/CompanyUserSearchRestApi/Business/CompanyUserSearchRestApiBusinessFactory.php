<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business;

use FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyUserSearchRestApi\CompanyUserSearchRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Persistence\CompanyUserSearchRestApiRepositoryInterface getRepository()
 */
class CompanyUserSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUserSearchRestApi\Business\Reader\CompanyUserReaderInterface
     */
    public function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getRepository(),
            $this->getProvidedDependency(
                CompanyUserSearchRestApiDependencyProvider::PLUGINS_SEARCH_COMPANY_USER_QUERY_EXPANDER,
            ),
        );
    }
}
