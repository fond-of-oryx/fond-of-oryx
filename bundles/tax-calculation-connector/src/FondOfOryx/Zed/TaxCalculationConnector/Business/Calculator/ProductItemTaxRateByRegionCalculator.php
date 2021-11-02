<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator;

use ArrayObject;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorConstants;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

class ProductItemTaxRateByRegionCalculator implements CalculatorInterface
{
    /**
     * @var \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface
     */
    protected $taxFacade;

    /**
     * @var string
     */
    protected $defaultTaxCountryIso2Code;

    /**
     * @var float
     */
    protected $defaultTaxRate;

    /**
     * @var int|null
     */
    protected $defaultRegionId;

    /**
     * @param \FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface $repository
     * @param \FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface $taxFacade
     */
    public function __construct(
        TaxCalculationConnectorRepositoryInterface $repository,
        TaxCalculationConnectorToTaxInterface $taxFacade
    ) {
        $this->repository = $repository;
        $this->taxFacade = $taxFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CalculableObjectTransfer $calculableObjectTransfer
     *
     * @return \Generated\Shared\Transfer\CalculableObjectTransfer
     */
    public function recalculateWithCalculableObject(CalculableObjectTransfer $calculableObjectTransfer): CalculableObjectTransfer
    {
        $itemTransfers = $this->recalculateWithItemTransfers($calculableObjectTransfer->getItems());
        $calculableObjectTransfer->setItems($itemTransfers);

        return $calculableObjectTransfer;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ItemTransfer>
     */
    protected function recalculateWithItemTransfers(ArrayObject $itemTransfers): ArrayObject
    {
        $taxRatesByIdProductAbstract = $this->getTaxSet($itemTransfers);

        foreach ($itemTransfers as $itemTransfer) {
            $taxRate = $this->getEffectiveTaxRate(
                $taxRatesByIdProductAbstract->getProductTaxSets(),
                $itemTransfer->getIdProductAbstract(),
                $this->getShippingCountryIso2CodeByItem($itemTransfer),
            );
            $itemTransfer->setTaxRate($taxRate);
        }

        return $itemTransfers;
    }

    /**
     * @param \ArrayObject $itemTransfers
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    protected function getTaxSet(ArrayObject $itemTransfers): TaxCalculationConnectorTransfer
    {
        $idRegions = $this->getRegionIds($itemTransfers);
        $idProductAbstracts = $this->getIdProductAbstract($itemTransfers);
        $countryIso2Code = $this->getCountryIso2Codes($itemTransfers);
        // Fallback to country if no regions are found
        if (count($idRegions) === 0) {
            return $this->repository
                ->getTaxSetByIdProductAbstractAndCountryIso2Codes(
                    $idProductAbstracts,
                    $countryIso2Code,
                );
        }

        return $this->repository
            ->getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(
                $idProductAbstracts,
                $countryIso2Code,
                $idRegions,
            );
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<string>
     */
    protected function getCountryIso2Codes(iterable $itemTransfers): array
    {
        $result = [];
        foreach ($itemTransfers as $itemTransfer) {
            $result[] = $this->getShippingCountryIso2CodeByItem($itemTransfer);
        }

        return array_unique($result);
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<int>
     */
    protected function getIdProductAbstract(iterable $itemTransfers): array
    {
        $result = [];
        foreach ($itemTransfers as $itemTransfer) {
            $result[] = $itemTransfer->getIdProductAbstract();
        }

        return array_unique($result);
    }

    /**
     * @return string
     */
    protected function getDefaultTaxCountryIso2Code(): string
    {
        if ($this->defaultTaxCountryIso2Code === null) {
            $this->defaultTaxCountryIso2Code = $this->taxFacade->getDefaultTaxCountryIso2Code();
        }

        return $this->defaultTaxCountryIso2Code;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    protected function getShippingCountryIso2CodeByItem(ItemTransfer $itemTransfer): string
    {
        if ($this->hasItemShippingAddressDefaultTaxCountryIso2Code($itemTransfer)) {
            return $itemTransfer->getShipment()->getShippingAddress()->getIso2Code();
        }

        return $this->getDefaultTaxCountryIso2Code();
    }

    /**
     * @return float
     */
    protected function getDefaultTaxRate(): float
    {
        if ($this->defaultTaxRate === null) {
            $this->defaultTaxRate = $this->taxFacade->getDefaultTaxRate();
        }

        return $this->defaultTaxRate;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer> $taxSets
     * @param int $idProductAbstract
     * @param string $countryIso2Code
     *
     * @return float
     */
    protected function getEffectiveTaxRate(
        ArrayObject $taxSets,
        int $idProductAbstract,
        string $countryIso2Code
    ): float {
        foreach ($taxSets as $taxSet) {
            if ($this->hasValidTaxRate($taxSet, $idProductAbstract, $countryIso2Code)) {
                return (float)$taxSet->getMaxTaxRate();
            }
        }

        return $this->getDefaultTaxRate();
    }

    /**
     * @param \Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer $taxSet
     * @param int $idProductAbstract
     * @param string $countryIso2Code
     *
     * @return bool
     */
    protected function hasValidTaxRate(
        TaxCalculationConnectorProductTaxSetTransfer $taxSet,
        int $idProductAbstract,
        string $countryIso2Code
    ): bool {
        if ($taxSet->getIdAbstractProduct() !== $idProductAbstract) {
            return false;
        }

        if (
            $taxSet->getCountryIso2Code() !== $countryIso2Code
            && $taxSet->getCountryIso2Code() !== TaxCalculationConnectorConstants::TAX_EXEMPT_PLACEHOLDER
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    protected function hasItemShippingAddressDefaultTaxCountryIso2Code(ItemTransfer $itemTransfer): bool
    {
        $shipmentTransfer = $itemTransfer->getShipment();

        return $shipmentTransfer !== null &&
            $shipmentTransfer->getShippingAddress() !== null &&
            $shipmentTransfer->getShippingAddress()->getIso2Code() !== null;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<int>
     */
    protected function getRegionIds(iterable $itemTransfers): array
    {
        $result = [];
        foreach ($itemTransfers as $itemTransfer) {
            $region = $this->getRegionIdByItem($itemTransfer);

            if ($region === null) {
                continue;
            }

            $result[] = $region;
        }

        return array_unique($result);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int|null
     */
    protected function getRegionIdByItem(ItemTransfer $itemTransfer): ?int
    {
        if ($this->hasItemShippingAddressDefaultRegionId($itemTransfer)) {
            return $itemTransfer->getShipment()->getShippingAddress()->getFkRegion();
        }

        return $this->getDefaultTaxRegionId();
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return bool
     */
    protected function hasItemShippingAddressDefaultRegionId(ItemTransfer $itemTransfer): bool
    {
        $shipmentTransfer = $itemTransfer->getShipment();

        return $shipmentTransfer !== null &&
            $shipmentTransfer->getShippingAddress() !== null &&
            $shipmentTransfer->getShippingAddress()->getFkRegion() !== null;
    }

    /**
     * @return int|null
     */
    protected function getDefaultTaxRegionId(): ?int
    {
        return $this->defaultRegionId;
    }
}
