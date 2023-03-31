<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business;

use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilter;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReader;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReader;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidator;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidatorInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriter;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\BusinessOnBehalfProductListConnectorDependencyProvider;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Persistence\BusinessOnBehalfProductListConnectorRepositoryInterface getRepository()
 */
class BusinessOnBehalfProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Filter\RestrictedItemsFilterInterface
     */
    public function createRestrictedItemsFilter(): RestrictedItemsFilterInterface
    {
        return new RestrictedItemsFilter(
            $this->createCompanyUserWriter(),
            $this->createQuoteExpander(),
            $this->getProductListFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Validator\ProductListRestrictionValidatorInterface
     */
    public function createProductListRestrictionValidator(): ProductListRestrictionValidatorInterface
    {
        return new ProductListRestrictionValidator(
            $this->createCompanyUserWriter(),
            $this->createQuoteExpander(),
            $this->getProductListFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Writer\CompanyUserWriterInterface
     */
    protected function createCompanyUserWriter(): CompanyUserWriterInterface
    {
        return new CompanyUserWriter(
            $this->createCompanyUserReader(),
            $this->createCustomerReader(),
            $this->getBusinessOnBehalfFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CompanyUserReaderInterface
     */
    protected function createCompanyUserReader(): CompanyUserReaderInterface
    {
        return new CompanyUserReader(
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Reader\CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getCustomerFacade(), $this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\Expander\QuoteExpanderInterface
     */
    protected function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander($this->createCustomerReader());
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): BusinessOnBehalfProductListConnectorToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(
            BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_CUSTOMER,
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface
     */
    protected function getBusinessOnBehalfFacade(): BusinessOnBehalfProductListConnectorToBusinessOnBehalfFacadeInterface
    {
        return $this->getProvidedDependency(
            BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_BUSINESS_ON_BEHALF,
        );
    }

    /**
     * @return \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Dependency\Facade\BusinessOnBehalfProductListConnectorToProductListFacadeInterface
     */
    protected function getProductListFacade(): BusinessOnBehalfProductListConnectorToProductListFacadeInterface
    {
        return $this->getProvidedDependency(
            BusinessOnBehalfProductListConnectorDependencyProvider::FACADE_PRODUCT_LIST,
        );
    }
}
