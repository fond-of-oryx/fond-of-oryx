<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Persistence;

use Generated\Shared\Transfer\ShipmentTableRateCriteriaFilterTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRate\Persistence\ShipmentTableRatePersistenceFactory getFactory()
 */
class ShipmentTableRateRepository extends AbstractRepository implements ShipmentTableRateRepositoryInterface
{
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
            $shipmentTableRateCriteriaFilterTransfer
        );

        $shipmentTableRate = $shipmentTableRateQuery->orderByZipCodePattern(Criteria::DESC)
            ->orderByPrice(Criteria::ASC)
            ->findOne();

        if ($shipmentTableRate === null) {
            return null;
        }

        return $this->getFactory()->createShipmentTableRateMapper()->mapEntityToTransfer(
            $shipmentTableRate,
            new ShipmentTableRateTransfer()
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

        if ($shipmentTableRateCriteriaFilterTransfer->getFkCountry()) {
            $shipmentTableRateQuery->filterByFkCountry($shipmentTableRateCriteriaFilterTransfer->getFkCountry());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getFkStore()) {
            $shipmentTableRateQuery->filterByFkStore($shipmentTableRateCriteriaFilterTransfer->getFkStore());
        }

        if ($shipmentTableRateCriteriaFilterTransfer->getPriceToPay()) {
            $shipmentTableRateQuery->filterByMinPriceToPay($shipmentTableRateCriteriaFilterTransfer->getPriceToPay(), Criteria::LESS_EQUAL);
        }

        return $shipmentTableRateQuery;
    }
}
