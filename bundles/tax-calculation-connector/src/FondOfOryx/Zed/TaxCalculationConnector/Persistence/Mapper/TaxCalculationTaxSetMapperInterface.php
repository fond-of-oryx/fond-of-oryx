<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper;

interface TaxCalculationTaxSetMapperInterface
{
    /**
     * @param iterable|\Propel\Runtime\Collection\ArrayCollection  $taxRateEntity
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function mapTaxRate(iterable $taxRateEntity): TaxCalculationConnectorTransfer;
}
