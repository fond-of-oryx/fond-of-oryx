<?php

namespace FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business;

use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business\Quote\ShipmentQuoteMapper;
use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Business\Quote\ShipmentQuoteMapperInterface;
use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Dependency\Facade\SplittableCheckoutShipmentsRestApiToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\SplittableCheckoutShipmentsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutShipmentsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapperInterface
     */
    public function createShipmentQuoteMapper(): ShipmentQuoteMapperInterface
    {
        return new ShipmentQuoteMapper($this->getShipmentFacade());
    }

    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Dependency\Facade\SplittableCheckoutShipmentsRestApiToShipmentFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getShipmentFacade(): SplittableCheckoutShipmentsRestApiToShipmentFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutShipmentsRestApiDependencyProvider::FACADE_SHIPMENT);
    }
}
