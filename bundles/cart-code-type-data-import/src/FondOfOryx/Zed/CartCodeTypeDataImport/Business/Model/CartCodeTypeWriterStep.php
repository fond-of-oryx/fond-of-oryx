<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport\Business\Model;

use FondOfOryx\Zed\CartCodeTypeDataImport\Business\Model\DateSet\CartCodeTypeDataSet;
use Orm\Zed\ProductLocaleRestriction\Persistence\FooCartCodeTypeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CartCodeTypeWriterStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $cartCodeTypeEntity = FooCartCodeTypeQuery::create()
            ->filterByName($dataSet[CartCodeTypeDataSet::CART_CODE_TYPE_NAME])
            ->findOneOrCreate();

        $cartCodeTypeEntity->fromArray($dataSet->getArrayCopy());

        $cartCodeTypeEntity->save();
    }
}
