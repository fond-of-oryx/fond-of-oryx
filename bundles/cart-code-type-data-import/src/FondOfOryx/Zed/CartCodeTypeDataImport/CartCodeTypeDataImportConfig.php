<?php

namespace FondOfOryx\Zed\CartCodeTypeDataImport;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Spryker\Zed\DataImport\DataImportConfig;

class CartCodeTypeDataImportConfig extends DataImportConfig
{
    public const IMPORT_TYPE_CART_CODE_TYPE = 'cart-code-type';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getCartCodeTypeDataImporterConfiguration(): DataImporterConfigurationTransfer
    {
        return $this->buildImporterConfiguration(
            'cart_code_type.csv',
            static::IMPORT_TYPE_CART_CODE_TYPE
        );
    }
}
