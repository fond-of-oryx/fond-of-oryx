<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompany\Dependency\Facade;

use Generated\Shared\Transfer\CurrencyTransfer;

interface JellyfishSalesOrderCompanyToCurrencyFacadeInterface
{
    /**
     * @param int $idCurrency
     *
     * @return \Generated\Shared\Transfer\CurrencyTransfer
     */
    public function getByIdCurrency(int $idCurrency): CurrencyTransfer;
}
