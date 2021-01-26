<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface ErpOrderToCompanyUserFacadeInterface
{
    /**
     * Specification:
     * - Retrieves company user by id
     * - Hydrates company field
     *
     * @api
     *
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getCompanyUserById(int $idCompanyUser): CompanyUserTransfer;
}
