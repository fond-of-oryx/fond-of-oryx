<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiCompanyConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpanderInterface
     */
    public function createReturnLabelRequestExpander(): ReturnLabelRequestExpanderInterface
    {
        return new ReturnLabelRequestExpander($this->createCompanyReader());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReaderInterface
     */
    protected function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader($this->getRepository());
    }
}
