<?php

namespace FondOfOryx\Zed\AvailabilityAlertDataImport\Business;

use FondOfOryx\Zed\AvailabilityAlertDataImport\Business\Model\AvailabilityAlertWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertDataImport\AvailabilityAlertDataImportConfig getConfig()
 */
class AvailabilityAlertDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createAvailabilityAlertImporter()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getAvailabilityAlertDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep(new AvailabilityAlertWriterStep());
        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
