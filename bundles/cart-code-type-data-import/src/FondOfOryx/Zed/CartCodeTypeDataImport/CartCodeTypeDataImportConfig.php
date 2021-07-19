<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class CartCodeTypeDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_CART_CODE_TYPE_TYPE = 'cart';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCartCodeTypeDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            'cart-code-type.csv',
            static::IMPORT_TYPE_CART_CODE_TYPE_TYPE
        );
    }
}
