<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface;
use FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface;
use FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class ShipmentTableRateReader implements ShipmentTableRateReaderInterface
{
    /**
     * @var int
     */
    protected const MAX_PRICE_TO_PAY = 2147483647;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected $zipCodePatternsGenerator;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface
     */
    protected $countryFacade;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface
     */
    protected $priceToPayFilterPlugin;

    /**
     * @param \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface $zipCodePatternsGenerator
     * @param \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRateRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToCountryFacadeInterface $countryFacade
     * @param \FondOfOryx\Zed\ShipmentTableRate\Dependency\Facade\ShipmentTableRateToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\ShipmentTableRateExtension\Dependency\Plugin\PriceToPayFilterPluginInterface $priceToPayFilterPlugin
     */
    public function __construct(
        ZipCodePatternsGeneratorInterface $zipCodePatternsGenerator,
        ShipmentTableRateRepositoryInterface $repository,
        ShipmentTableRateToCountryFacadeInterface $countryFacade,
        ShipmentTableRateToStoreFacadeInterface $storeFacade,
        PriceToPayFilterPluginInterface $priceToPayFilterPlugin
    ) {
        $this->zipCodePatternsGenerator = $zipCodePatternsGenerator;
        $this->countryFacade = $countryFacade;
        $this->storeFacade = $storeFacade;
        $this->repository = $repository;
        $this->priceToPayFilterPlugin = $priceToPayFilterPlugin;
    }

    /**
     * @param \Generated\Shared\Transfer\ShipmentTransfer $shipmentTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getByShipmentAndQuote(
        ShipmentTransfer $shipmentTransfer,
        QuoteTransfer $quoteTransfer
    ): ?ShipmentTableRateTransfer {
        $shippingAddressTransfer = $shipmentTransfer->getShippingAddress();
        $totalsTransfer = $quoteTransfer->getTotals();
        $storeTransfer = $quoteTransfer->getStore();

        if ($shippingAddressTransfer === null || $totalsTransfer === null || $storeTransfer === null) {
            return null;
        }

        $shipmentTableRateCriteriaFilter = $this->createShipmentTableRateCriteriaFilter(
            $shippingAddressTransfer,
            $quoteTransfer,
        );

        if ($shipmentTableRateCriteriaFilter === null) {
            return null;
        }

        return $this->repository->getShipmentTableRate($shipmentTableRateCriteriaFilter);
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $shippingAddressTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer|null
     */
    protected function createShipmentTableRateCriteriaFilter(
        AddressTransfer $shippingAddressTransfer,
        QuoteTransfer $quoteTransfer
    ): ?ShipmentTableRateCriteriaFilterTransfer {
        $iso2Code = $shippingAddressTransfer->getIso2Code();
        $storeName = $quoteTransfer->getStore()->getName();
        $zipCode = $shippingAddressTransfer->getZipCode();

        $priceToPay = $this->priceToPayFilterPlugin->filter($quoteTransfer);

        if ($iso2Code === null || $storeName === null || $zipCode === null || $priceToPay === null) {
            return null;
        }

        $countryTransfer = $this->countryFacade->getCountryByIso2Code($iso2Code);
        $storeTransfer = $this->storeFacade->getStoreByName($storeName);

        return (new ShipmentTableRateCriteriaFilterTransfer())
            ->setFkCountry($countryTransfer->getIdCountry())
            ->setFkStore($storeTransfer->getIdStore())
            ->setPriceToPay(min($priceToPay, static::MAX_PRICE_TO_PAY))
            ->setZipCodePatterns($this->zipCodePatternsGenerator->generateFromZipCode($zipCode));
    }
}
