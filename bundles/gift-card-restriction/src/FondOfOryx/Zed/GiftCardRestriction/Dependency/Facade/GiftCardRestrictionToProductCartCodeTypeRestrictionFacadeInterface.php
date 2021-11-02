<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Dependency\Facade;

interface GiftCardRestrictionToProductCartCodeTypeRestrictionFacadeInterface
{
    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array;
}
