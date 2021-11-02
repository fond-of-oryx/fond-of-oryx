<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Business\Model;

use FondOfOryx\Zed\ShipmentTableRateDataImport\Business\Model\DataSet\ShipmentTableRateDataSet;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\ShipmentTableRate\Persistence\FooShipmentTableRateQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShipmentTableRateWriterStep implements DataImportStepInterface
{
    /**
     * @var array<int>
     */
    protected static $countryIdsCache = [];

    /**
     * @var array<int>
     */
    protected static $storeIdsCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $shipmentTableRateEntity = FooShipmentTableRateQuery::create()
            ->filterByKey($dataSet[ShipmentTableRateDataSet::SHIPMENT_TABLE_RATE_KEY])
            ->findOneOrCreate();

        $shipmentTableRateEntity->fromArray($dataSet->getArrayCopy());

        if ($dataSet[ShipmentTableRateDataSet::SHIPMENT_TABLE_RATE_MAX_PRICE_TO_PAY] === '') {
            $shipmentTableRateEntity->setMaxPriceToPay(null);
        }

        $shipmentTableRateEntity->setFkCountry(
            $this->getCountryIdByIso2Code($dataSet[ShipmentTableRateDataSet::SHIPMENT_TABLE_RATE_COUNTRY]),
        )->setFkStore(
            $this->getStoreIdByName($dataSet[ShipmentTableRateDataSet::SHIPMENT_TABLE_RATE_STORE]),
        );

        $shipmentTableRateEntity->save();
    }

    /**
     * @param string $countryIso2Code
     *
     * @return int
     */
    protected function getCountryIdByIso2Code(string $countryIso2Code): int
    {
        if (!isset(static::$countryIdsCache[$countryIso2Code])) {
            static::$countryIdsCache[$countryIso2Code] = SpyCountryQuery::create()
                ->findOneByIso2Code($countryIso2Code)
                ->getIdCountry();
        }

        return static::$countryIdsCache[$countryIso2Code];
    }

    /**
     * @param string $name
     *
     * @return int
     */
    protected function getStoreIdByName(string $name): int
    {
        if (!isset(static::$storeIdsCache[$name])) {
            static::$storeIdsCache[$name] = SpyStoreQuery::create()
                ->findOneByName($name)
                ->getIdStore();
        }

        return static::$storeIdsCache[$name];
    }
}
