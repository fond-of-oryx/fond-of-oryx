<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitBusinessUnitExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitBusinessUnitReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiCompanyBusinessUnitConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpanderInterface
     */
    public function createCompanyBusinessUnitExpander(): CompanyBusinessUnitExpanderInterface
    {
        return new CompanyBusinessUnitBusinessUnitExpander($this->createCompanyReader());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected function createCompanyReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitBusinessUnitReader($this->getRepository());
    }
}
