<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence;

use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery;
use Orm\Zed\ShipmentTableRate\Persistence\Map\FooShipmentTableRateTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRatePersistenceFactory getFactory()
 */
class ShipmentTableRateRepository extends AbstractRepository implements ShipmentTableRateRepositoryInterface
{
    /**
     * @var string
     */
    public const CONDITION_IS_MAX_PRICE_TO_PAY_GREATER_THEN_PRICE_TO_PAY = 'isMaxPriceToPayGreaterThenPriceToPay';

    /**
     * @var string
     */
    public const CONDITION_IS_MAX_PRICE_TO_PAY_EQUAL_INFINITY = 'isMaxPriceToPayEqualInfinity';

    /**
     * @param \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\ShipmentTableRateTransfer|null
     */
    public function getShipmentTableRate(
        ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
    ): ?ShipmentTableRateTransfer {
        $shipmentTableRateQuery = $this->getFactory()->createShipmentTableRateQuery();

        $shipmentTableRateQuery = $this->applyShipmentTableRateCriteriaFilters(
            $shipmentTableRateQuery,
            $shipmentTableRateCriteriaFilterTransfer,
        );

        $shipmentTableRate = $shipmentTableRateQuery->orderByZipCodePattern(Criteria::DESC)
            ->findOne();

        if ($shipmentTableRate === null) {
            return null;
        }

        return $this->getFactory()->createShipmentTableRateMapper()->mapEntityToTransfer(
            $shipmentTableRate,
            new ShipmentTableRateTransfer(),
        );
    }

    /**
     * @param \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery $shipmentTableRateQuery
     * @param \Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
     *
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery
     */
    protected function applyShipmentTableRateCriteriaFilters(
        FooShipmentTableRateQuery $shipmentTableRateQuery,
        ShipmentTableRateCriteriaFilterTransfer $shipmentTableRateCriteriaFilterTransfer
    ): FooShipmentTableRateQuery {
        if ($shipmentTableRateCriteriaFilterTransfer->getZipCodePatterns()) {
            $shipmentTableRateQuery->filterByZipCodePattern_In($shipmentTableRateCriteriaFilterTransfer->getZipCodePatterns());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getFkCountry() !== null) {
            $shipmentTableRateQuery->filterByFkCountry($shipmentTableRateCriteriaFilterTransfer->getFkCountry());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getFkStore() !== null) {
            $shipmentTableRateQuery->filterByFkStore($shipmentTableRateCriteriaFilterTransfer->getFkStore());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getPriceToPay() !== null) {
            $priceToPay = $shipmentTableRateCriteriaFilterTransfer->getPriceToPay();

            $shipmentTableRateQuery->filterByMinPriceToPay(
                $priceToPay,
                Criteria::LESS_EQUAL,
            )->condition(
                static::CONDITION_IS_MAX_PRICE_TO_PAY_GREATER_THEN_PRICE_TO_PAY,
                FooShipmentTableRateTableMap::COL_MAX_PRICE_TO_PAY . ' > ?',
                $priceToPay,
            )->condition(
                static::CONDITION_IS_MAX_PRICE_TO_PAY_EQUAL_INFINITY,
                FooShipmentTableRateTableMap::COL_MAX_PRICE_TO_PAY . ' IS NULL',
            )->combine(
                [
                    static::CONDITION_IS_MAX_PRICE_TO_PAY_GREATER_THEN_PRICE_TO_PAY,
                    static::CONDITION_IS_MAX_PRICE_TO_PAY_EQUAL_INFINITY,
                ],
                Criteria::LOGICAL_OR,
            );
        }

        return $shipmentTableRateQuery;
    }
}
