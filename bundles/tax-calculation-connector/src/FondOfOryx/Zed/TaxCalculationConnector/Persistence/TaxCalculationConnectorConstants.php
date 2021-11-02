<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence;

interface TaxCalculationConnectorConstants
{
    /**
     * @var string
     */
    public const COL_MAX_TAX_RATE = 'MaxTaxRate';

    /**
     * @var string
     */
    public const COL_ID_ABSTRACT_PRODUCT = 'IdProductAbstract';

    /**
     * @var string
     */
    public const COL_COUNTRY_CODE = 'COUNTRY_CODE';

    /**
     * @var string
     */
    public const TAX_EXEMPT_PLACEHOLDER = 'Tax Exempt';
}
