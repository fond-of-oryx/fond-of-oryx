<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Business;

use FondOfOryx\Zed\CartCodeTypeDataImport\Business\Model\CartCodeTypeWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

/**
 * @method \FondOfOryx\Zed\CartCodeTypeDataImport\CartCodeTypeDataImportConfig getConfig()
 */
class CartCodeTypeDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createCartCodeTypeDataImporter(): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig(
            $this->getConfig()->getCartCodeTypeDataImporterConfiguration()
        );

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep(new CartCodeTypeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
