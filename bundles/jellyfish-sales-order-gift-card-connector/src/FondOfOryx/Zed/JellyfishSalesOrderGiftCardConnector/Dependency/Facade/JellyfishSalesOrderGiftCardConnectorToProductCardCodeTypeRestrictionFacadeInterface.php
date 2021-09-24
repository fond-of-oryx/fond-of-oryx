<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade;

interface JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
{
    /**
     * @param array $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array;
}
