<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\Persistence;

use Generated\Shared\Transfer\CompanyCollectionTransfer;

interface CompanyUsersBulkRestApiDebtorConnectorRepositoryInterface
{
    /**
     * @param array $debtorNumbers
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function findCompaniesByDebtorNumbers(array $debtorNumbers): CompanyCollectionTransfer;
}
