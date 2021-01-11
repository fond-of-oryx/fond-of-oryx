<?php

namespace FondOfOryx\Zed\TaxCalculationConnector\Persistence\Mapper;

use Generated\Shared\Transfer\TaxCalculationConnectorTransfer;

interface TaxCalculationTaxSetMapperInterface
{
    /**
     * @param iterable|\Propel\Runtime\Collection\ArrayCollection $taxRateEntity
     *
     * @return \Generated\Shared\Transfer\TaxCalculationConnectorTransfer
     */
    public function mapTaxRate(iterable $taxRateEntity): TaxCalculationConnectorTransfer;
}
