<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelsRestApiCompanyBusinessUnitConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpanderInterface
     */
    public function createCompanyBusinessUnitExpander(): CompanyBusinessUnitExpanderInterface
    {
        return new CompanyBusinessUnitExpander($this->createCompanyBusinessUnitReader());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader();
    }
}
