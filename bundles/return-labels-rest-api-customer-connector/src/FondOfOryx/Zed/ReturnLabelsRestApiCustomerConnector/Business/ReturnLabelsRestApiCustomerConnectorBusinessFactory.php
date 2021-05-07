<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReader;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelsRestApiCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface
     */
    public function createCustomerExpander(): CustomerExpanderInterface
    {
        return new CustomerExpander($this->createCustomerReader());
    }

    /**
     * @return CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader();
    }
}
