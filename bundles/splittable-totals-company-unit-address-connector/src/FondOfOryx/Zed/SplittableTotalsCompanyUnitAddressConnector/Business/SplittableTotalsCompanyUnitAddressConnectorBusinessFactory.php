<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business;

use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpanderInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper\AddressMapper;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\SplittableTotalsCompanyUnitAddressConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface getRepository()
 */
class SplittableTotalsCompanyUnitAddressConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander\QuoteExpanderInterface
     */
    public function createQuoteExpander(): QuoteExpanderInterface
    {
        return new QuoteExpander(
            $this->createCompanyUnitAddressReader()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader(
            $this->createAddressMapper(),
            $this->getRepository(),
            $this->getCompanyUnitAddressFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface
     */
    protected function createAddressMapper(): AddressMapperInterface
    {
        return new AddressMapper();
    }

    /**
     * @return \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
     */
    protected function getCompanyUnitAddressFacade(): SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(
            SplittableTotalsCompanyUnitAddressConnectorDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS
        );
    }
}
