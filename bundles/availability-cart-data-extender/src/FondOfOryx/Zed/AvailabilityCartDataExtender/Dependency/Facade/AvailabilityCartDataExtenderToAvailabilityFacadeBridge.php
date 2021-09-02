<?php

namespace FondOfOryx\Zed\AvailabilityCartDataExtender\Dependency\Facade;

use Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer;
use Generated\Shared\Transfer\ProductConcreteAvailabilityRequestTransfer;
use Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Availability\Business\AvailabilityFacadeInterface;

class AvailabilityCartDataExtenderToAvailabilityFacadeBridge implements AvailabilityCartDataExtenderToAvailabilityFacadeInterface
{
    /**
     * @var \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface $availabilityFacade
     */
    public function __construct(AvailabilityFacadeInterface $availabilityFacade)
    {
        $this->facade = $availabilityFacade;
    }

    /**
     * Specification:
     *  - Checks if product is never out of stock for given store.
     *  - Checks if product has stock in stock table.
     *  - Checks if have placed orders where items have state machine state flagged as reserved.
     *
     * @api
     *
     * @param string $sku
     * @param \Spryker\DecimalObject\Decimal $quantity
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param \Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer|null $productAvailabilityCriteriaTransfer
     *
     * @return bool
     */
    public function isProductSellableForStore(
        string $sku,
        Decimal $quantity,
        StoreTransfer $storeTransfer,
        ?ProductAvailabilityCriteriaTransfer $productAvailabilityCriteriaTransfer = null
    ): bool {
        return $this->facade->isProductSellableForStore($sku, $quantity, $storeTransfer, $productAvailabilityCriteriaTransfer);
    }

    /**
     * Specification:
     *  - Finds product concrete availability as is stored in persistence.
     *  - If nothing was stored in persistence, concrete availability will be calculated and stored.
     *
     * @api
     *
     * @param string $sku
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param \Generated\Shared\Transfer\ProductAvailabilityCriteriaTransfer|null $productAvailabilityCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteAvailabilityTransfer|null
     */
    public function findOrCreateProductConcreteAvailabilityBySkuForStore(
        string $sku,
        StoreTransfer $storeTransfer,
        ?ProductAvailabilityCriteriaTransfer $productAvailabilityCriteriaTransfer = null
    ): ?ProductConcreteAvailabilityTransfer {
        if (method_exists($this->facade, 'findOrCreateProductConcreteAvailabilityBySkuForStore')) {
            return $this->facade->findOrCreateProductConcreteAvailabilityBySkuForStore($sku, $storeTransfer, $productAvailabilityCriteriaTransfer);
        }

        //Keeps support for older spryker/availability-cart-connector versions
        return $this->facade->findProductConcreteAvailability((new ProductConcreteAvailabilityRequestTransfer())->setSku($sku));
    }
}
