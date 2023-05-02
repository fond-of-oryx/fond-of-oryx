<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface CompanyUserManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function createCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void;
}
