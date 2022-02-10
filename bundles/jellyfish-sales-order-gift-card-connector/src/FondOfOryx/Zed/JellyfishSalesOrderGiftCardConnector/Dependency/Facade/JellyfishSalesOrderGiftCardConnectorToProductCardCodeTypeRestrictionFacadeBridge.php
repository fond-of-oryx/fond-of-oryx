<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade;

use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface;

class JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge implements JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface
     */
    protected $productCartCodeTypeRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade
     */
    public function __construct(
        ProductCartCodeTypeRestrictionFacadeInterface $productCartCodeTypeRestrictionFacade
    ) {
        $this->productCartCodeTypeRestrictionFacade = $productCartCodeTypeRestrictionFacade;
    }

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array
    {
        return $this->productCartCodeTypeRestrictionFacade
            ->getBlacklistedCartCodeTypesByProductConcreteSkus($productConcreteSkus);
    }
}
