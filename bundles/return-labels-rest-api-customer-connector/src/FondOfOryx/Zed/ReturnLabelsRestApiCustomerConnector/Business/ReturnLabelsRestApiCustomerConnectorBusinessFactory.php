<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\ReturnLabelsRestApiCustomerConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ReturnLabelsRestApiCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface
     */
    public function createCustomerExpander(): CustomerExpanderInterface
    {
        return new CustomerExpander(
            $this->createCustomerReader(),
            $this->createReturnLabelRequestCustomerMapper(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getCustomerFacade());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface
     */
    protected function createReturnLabelRequestCustomerMapper(): ReturnLabelRequestCustomerMapperInterface
    {
        return new ReturnLabelRequestCustomerMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiCustomerConnectorDependencyProvider::FACADE_CUSTOMER);
    }
}
