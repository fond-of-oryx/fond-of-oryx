<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business;

use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilter;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilter;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\CompanyProductListSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface getRepository()
 */
class CompanyProductListSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
     */
    public function createSearchProductListQueryExpander(): SearchProductListQueryExpanderInterface
    {
        return new SearchProductListQueryExpander(
            $this->createCompanyUuidFilter(),
            $this->createCompanyUserReader(),
            $this->getPermissionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface
     */
    protected function createCompanyUuidFilter(): CompanyUuidFilterInterface
    {
        return new CompanyUuidFilter();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->createIdCustomerFilter(),
            $this->createCompanyUuidFilter(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected function createIdCustomerFilter(): IdCustomerFilterInterface
    {
        return new IdCustomerFilter();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyProductListSearchRestApiToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(CompanyProductListSearchRestApiDependencyProvider::FACADE_PERMISSION);
    }
}
