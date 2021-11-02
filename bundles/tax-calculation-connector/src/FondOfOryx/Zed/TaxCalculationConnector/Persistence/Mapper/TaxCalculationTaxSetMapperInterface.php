<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper;

use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

interface TaxCalculationTaxSetMapperInterface
{
    /**
     * @param \Propel\Runtime\Collection\ArrayCollection|iterable $taxRateEntity
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function mapTaxRate(iterable $taxRateEntity): TaxCalculationConnectorTransfer;
}
