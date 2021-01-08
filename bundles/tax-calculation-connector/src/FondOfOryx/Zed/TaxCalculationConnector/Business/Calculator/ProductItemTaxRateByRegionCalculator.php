<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Business\Calculator;

use ArrayObject;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorConstants;
use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorRepositoryInterface;
use Generated\Shared\Transfer\CalculableObjectTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use FondOfOryx\Zed\TaxCalculationConnector\Dependency\Facade\TaxCalculationConnectorToTaxInterface;
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
     * @var null|int
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
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[]
     */
    protected function recalculateWithItemTransfers(ArrayObject $itemTransfers): ArrayObject
    {

        $taxRatesByIdProductAbstract= $this->getTaxSet($itemTransfers);

        foreach ($itemTransfers as $itemTransfer) {
            $taxRate = $this->getEffectiveTaxRate(
                $taxRatesByIdProductAbstract->getProductTaxSets()->getArrayCopy(),
                $itemTransfer->getIdProductAbstract(),
                $this->getShippingCountryIso2CodeByItem($itemTransfer)
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
                    $countryIso2Code
                );
        }

        return $this->repository
            ->getTaxSetByIdProductAbstractAndCountryIso2CodesAndIdRegions(
                $idProductAbstracts,
                $countryIso2Code,
                $idRegions
            );
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return string[]
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
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return int[]
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
     * @param array $mappedTaxRates
     * @param int $idProductAbstract
     * @param string $countryIso2Code
     *
     * @return float
     */
    protected function getEffectiveTaxRate(
        array $mappedTaxRates,
        int $idProductAbstract,
        string $countryIso2Code
    ): float {

        $taxRate = $mappedTaxRates[$idProductAbstract][$countryIso2Code] ??
            $mappedTaxRates[$idProductAbstract][TaxCalculationConnectorConstants::TAX_EXEMPT_PLACEHOLDER] ??
            $this->getDefaultTaxRate();

        return (float)$taxRate;
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
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $itemTransfers
     *
     * @return int[]
     */
    protected function getRegionIds(iterable $itemTransfers): array
    {
        $result = [];
        foreach ($itemTransfers as $itemTransfer) {
            $region = $this->getRegionIdByItem($itemTransfer);

            if($region === null) {
                continue;
            }

            $result[] = $region;
        }

        return array_unique($result);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return null|int
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
     * @return null|int
     */
    protected function getDefaultTaxRegionId(): ?int
    {
        return $this->defaultRegionId;
    }

}
