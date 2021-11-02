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
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\TotalsTransfer;

class ShipmentTableRateReader implements ShipmentTableRateReaderInterface
{
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
            $totalsTransfer,
            $storeTransfer,
        );

        if ($shipmentTableRateCriteriaFilter === null) {
            return null;
        }

        return $this->repository->getShipmentTableRate($shipmentTableRateCriteriaFilter);
    }

    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $shippingAddressTransfer
     * @param \Generated\Shared\Transfer\TotalsTransfer $totalsTransfer
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer|null
     */
    protected function createShipmentTableRateCriteriaFilter(
        AddressTransfer $shippingAddressTransfer,
        TotalsTransfer $totalsTransfer,
        StoreTransfer $storeTransfer
    ): ?ShipmentTableRateCriteriaFilterTransfer {
        $iso2Code = $shippingAddressTransfer->getIso2Code();
        $storeName = $storeTransfer->getName();
        $zipCode = $shippingAddressTransfer->getZipCode();
        $priceToPay = $this->priceToPayFilterPlugin->filter($totalsTransfer);

        if ($iso2Code === null || $storeName === null || $zipCode === null || $priceToPay === null) {
            return null;
        }

        $countryTransfer = $this->countryFacade->getCountryByIso2Code($iso2Code);
        $storeTransfer = $this->storeFacade->getStoreByName($storeName);

        return (new ShipmentTableRateCriteriaFilterTransfer())
            ->setFkCountry($countryTransfer->getIdCountry())
            ->setFkStore($storeTransfer->getIdStore())
            ->setPriceToPay($priceToPay)
            ->setZipCodePatterns($this->zipCodePatternsGenerator->generateFromZipCode($zipCode));
    }
}
