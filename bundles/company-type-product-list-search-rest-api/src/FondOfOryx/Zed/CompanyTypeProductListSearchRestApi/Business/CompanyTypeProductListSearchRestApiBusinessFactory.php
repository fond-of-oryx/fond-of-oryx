<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business;

use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilter;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilter;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface getRepository()
 */
class CompanyTypeProductListSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpanderInterface
     */
    public function createSearchProductListQueryExpander(): SearchProductListQueryExpanderInterface
    {
        return new SearchProductListQueryExpander(
            $this->createForeignCustomerReferenceFilter(),
            $this->createIdCustomerFilter(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface
     */
    protected function createForeignCustomerReferenceFilter(): ForeignCustomerReferenceFilterInterface
    {
        return new ForeignCustomerReferenceFilter();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected function createIdCustomerFilter(): IdCustomerFilterInterface
    {
        return new IdCustomerFilter();
    }
}
