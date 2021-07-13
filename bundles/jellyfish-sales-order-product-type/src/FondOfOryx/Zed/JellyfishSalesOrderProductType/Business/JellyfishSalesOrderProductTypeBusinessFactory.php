<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Business;

use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpander;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishProductTypeToProductFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\JellyfishSalesOrderProductTypeDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;


class JellyfishSalesOrderProductTypeBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderProductType\Business\Expander\JellyfishOrderItemExpanderInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createJellyfishOrderItemExpander(): JellyfishOrderItemExpanderInterface
    {
        return new JellyfishOrderItemExpander($this->getGiftCatdFacade());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getGiftCatdFacade(): JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderProductTypeDependencyProvider::FACADE_GIFT_CARD);
    }
}
