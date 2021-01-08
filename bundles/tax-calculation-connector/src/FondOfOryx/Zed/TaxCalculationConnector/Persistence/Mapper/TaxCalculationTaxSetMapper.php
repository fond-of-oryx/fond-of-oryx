<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper;

class TaxCalculationTaxSetMapper
{
    /**
     * @param iterable|\Propel\Runtime\Collection\ArrayCollection  $taxRateEntity
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function mapTaxRate(iterable $taxRateEntity): TaxCalculationConnectorTransfer
    {
        $transfer = new TaxCalculationConnectorTransfer();

        foreach ($taxRateEntity as $taxRate) {
            $transfer->addItem(
                (new TaxCalculationConnectorProductTaxSet())
                    ->setIdProductAbstract($taxRate[static::COL_ID_ABSTRACT_PRODUCT])
                    ->setCountryIso2Code($taxRate[static::COL_COUNTRY_CODE] ?? static::TAX_EXEMPT_PLACEHOLDER)
                    ->setMaxTaxRate($taxRate[static::COL_MAX_TAX_RATE])
            );
        }

        return $transfer;
    }
}
