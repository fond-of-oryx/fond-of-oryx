<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper;

use FondOfOryx\Zed\TaxCalculationConnector\Persistence\TaxCalculationConnectorConstants;
use Generated\Shared\Transfer\TaxCalculationConnectorProductTaxSetTransfer;
use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

class TaxCalculationTaxSetMapper
{
    /**
     * @param \Propel\Runtime\Collection\ArrayCollection|iterable $taxRateEntity
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function mapTaxRate(iterable $taxRateEntity): TaxCalculationConnectorTransfer
    {
        $transfer = new TaxCalculationConnectorTransfer();

        foreach ($taxRateEntity as $taxRate) {
            $transfer->addProductTaxSets(
                (new TaxCalculationConnectorProductTaxSetTransfer())
                    ->setIdAbstractProduct($taxRate[TaxCalculationConnectorConstants::COL_ID_ABSTRACT_PRODUCT])
                    ->setCountryIso2Code($taxRate[TaxCalculationConnectorConstants::COL_COUNTRY_CODE] ?? TaxCalculationConnectorConstants::TAX_EXEMPT_PLACEHOLDER)
                    ->setMaxTaxRate($taxRate[TaxCalculationConnectorConstants::COL_MAX_TAX_RATE]),
            );
        }

        return $transfer;
    }
}
