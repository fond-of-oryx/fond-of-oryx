<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig getConfig()
 */
class ReturnLabelsRestApiCompanyUnitAddressConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpanderInterface
     */
    public function createReturnLabelRequestExpander(): ReturnLabelRequestExpanderInterface
    {
        return new ReturnLabelRequestExpander(
            $this->createCompanyUnitAddressReader(),
            $this->createReturnLabelRequestAddressMapper(),
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface
     */
    protected function createReturnLabelRequestAddressMapper(): ReturnLabelRequestAddressMapperInterface
    {
        return new ReturnLabelRequestAddressMapper();
    }
}
