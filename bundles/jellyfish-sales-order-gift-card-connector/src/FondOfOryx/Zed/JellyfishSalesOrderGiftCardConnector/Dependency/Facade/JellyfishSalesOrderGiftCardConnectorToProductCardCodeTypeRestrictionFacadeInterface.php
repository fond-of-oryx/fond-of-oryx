<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade;

interface JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
{
    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array;
}
