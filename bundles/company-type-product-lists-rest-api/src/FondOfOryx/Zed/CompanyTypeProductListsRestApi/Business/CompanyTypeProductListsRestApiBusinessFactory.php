<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpander;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpanderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReader;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReader;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface getRepository()
 */
class CompanyTypeProductListsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpanderInterface
     */
    public function createRestProductListUpdateRequestExpander(): RestProductListUpdateRequestExpanderInterface
    {
        return new RestProductListUpdateRequestExpander(
            $this->createCompanyUserReader(),
            $this->createCustomerReader(),
            $this->createCompanyReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader\CompanyReaderInterface
     */
    protected function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader($this->getRepository());
    }
}
