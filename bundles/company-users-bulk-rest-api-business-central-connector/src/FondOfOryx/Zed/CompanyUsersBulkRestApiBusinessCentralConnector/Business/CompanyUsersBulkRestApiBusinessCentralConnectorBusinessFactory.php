<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Business;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Expander\ExpanderInterface;
use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Business\Expander\CompanyDebtorNumberExpander;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence\CompanyUsersBulkRestApiBusinessCentralConnectorRepositoryInterface getRepository()
 */
class CompanyUsersBulkRestApiBusinessCentralConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Expander\ExpanderInterface
     */
    public function createCompanyDebtorNumberExpander(): ExpanderInterface
    {
        return new CompanyDebtorNumberExpander($this->getRepository());
    }
}
