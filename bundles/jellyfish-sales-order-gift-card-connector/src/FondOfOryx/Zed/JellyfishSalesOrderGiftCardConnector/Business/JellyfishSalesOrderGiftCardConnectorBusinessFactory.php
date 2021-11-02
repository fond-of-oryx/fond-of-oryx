<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business;

use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpander;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapper;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\JellyfishSalesOrderGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    public function createJellyfishOrderItemExpander(): JellyfishOrderItemExpanderInterface
    {
        return new JellyfishOrderItemExpander();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander\JellyfishOrderExpanderInterface
     */
    public function createJellyfishOrderExpander(): JellyfishOrderExpanderInterface
    {
        return new JellyfishOrderExpander(
            $this->createGiftCardMapper(),
            $this->getProductCardCodeTypeRestrictionFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected function createGiftCardMapper(): JellyfishOrderGiftCardMapperInterface
    {
        return new JellyfishOrderGiftCardMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
     */
    protected function getProductCardCodeTypeRestrictionFacade(): JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderGiftCardConnectorDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION);
    }
}
