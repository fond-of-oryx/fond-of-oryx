<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business;

use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpander;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\JellyfishSalesOrderProductTypeDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class JellyfishSalesOrderProductTypeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface
     */
    public function createJellyfishOrderItemExpander(): JellyfishOrderItemExpanderInterface
    {
        return new JellyfishOrderItemExpander($this->getGiftCartFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
     */
    protected function getGiftCartFacade(): JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderProductTypeDependencyProvider::FACADE_GIFT_CARD);
    }
}
