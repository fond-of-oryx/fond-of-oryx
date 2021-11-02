<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Business;

use FondOfOryx\Zed\ShipmentTableRateDataImport\Business\Model\ShipmentTableRateWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \FondOfOryx\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig getConfig()
 */
class ShipmentTableRateDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createShipmentTableRateImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig(
            $this->getConfig()->getShipmentTableRateDataImporterConfiguration(),
        );

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep(new ShipmentTableRateWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
