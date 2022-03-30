<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyOmsMailConnectorToCompanyFacadeInterface
{
    /**
     * Specification:
     * - Finds a company by id.
     * - Returns null if company does not exist.
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function findCompanyById(int $idCompany): ?CompanyTransfer;
}
