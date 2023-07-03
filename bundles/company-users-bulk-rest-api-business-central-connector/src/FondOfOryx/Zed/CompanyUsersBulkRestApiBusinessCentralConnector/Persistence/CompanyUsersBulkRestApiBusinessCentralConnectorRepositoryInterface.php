<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence;

use Generated\Shared\Transfer\CompanyCollectionTransfer;

interface CompanyUsersBulkRestApiBusinessCentralConnectorRepositoryInterface
{
    /**
     * @param array $debtorNumbers
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function findCompaniesByDebtorNumbers(array $debtorNumbers): CompanyCollectionTransfer;
}
