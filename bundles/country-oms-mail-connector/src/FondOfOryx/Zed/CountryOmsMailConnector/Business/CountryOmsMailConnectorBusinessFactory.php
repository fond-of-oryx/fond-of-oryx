<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business;

use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpander;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpanderInterface;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpander;
use FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CountryOmsMailConnector\Persistence\CountryOmsMailConnectorRepositoryInterface getRepository()
 */
class CountryOmsMailConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpanderInterface
     */
    public function createOmsOrderMailExpander(): OmsOrderMailExpanderInterface
    {
        return new OmsOrderMailExpander(
            $this->createAddressExpander(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpanderInterface
     */
    protected function createAddressExpander(): AddressExpanderInterface
    {
        return new AddressExpander(
            $this->getRepository(),
        );
    }
}
