<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business;

use FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReader;
use FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanySearchRestApi\CompanySearchRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanySearchRestApi\Persistence\CompanySearchRestApiRepositoryInterface getRepository()
 */
class CompanySearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanySearchRestApi\Business\Reader\CompanyReaderInterface
     */
    public function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader(
            $this->getRepository(),
            $this->getSearchCompanyQueryExpanderPlugins(),
            $this->getCompanyExpanderPlugins(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\SearchCompanyQueryExpanderPluginInterface>
     */
    protected function getSearchCompanyQueryExpanderPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanySearchRestApiDependencyProvider::PLUGINS_SEARCH_COMPANY_QUERY_EXPANDER,
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanySearchRestApiExtension\Dependency\Plugin\CompanyExpanderPluginInterface>
     */
    protected function getCompanyExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CompanySearchRestApiDependencyProvider::PLUGINS_COMPANY_EXPANDER);
    }
}
