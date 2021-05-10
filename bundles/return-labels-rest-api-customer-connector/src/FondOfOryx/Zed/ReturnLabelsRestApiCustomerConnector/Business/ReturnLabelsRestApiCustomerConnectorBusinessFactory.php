<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReader;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Persistence\ReturnLabelsRestApiCustomerConnectorRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiCustomerConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface
     */
    public function createCustomerExpander(): CustomerExpanderInterface
    {
        return new CustomerExpander(
            $this->createCustomerReader(),
            $this->createReturnLabelRequestCustomerMapper()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface
     */
    protected function createReturnLabelRequestCustomerMapper(): ReturnLabelRequestCustomerMapperInterface
    {
        return new ReturnLabelRequestCustomerMapper();
    }
}
