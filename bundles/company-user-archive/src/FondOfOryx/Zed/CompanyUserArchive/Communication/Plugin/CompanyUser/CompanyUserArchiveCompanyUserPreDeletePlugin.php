<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Communication\Plugin\CompanyUser;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreDeletePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveFacadeInterface getFacade()
 */
class CompanyUserArchiveCompanyUserPreDeletePlugin extends AbstractPlugin implements CompanyUserPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return void
     */
    public function preDelete(CompanyUserTransfer $companyUserTransfer): void
    {
        $companyUserArchiveTransfer = (new CompanyUserArchiveTransfer())
            ->fromArray($companyUserTransfer->toArray(), true);

        $this->getFacade()->createCompanyUserArchive($companyUserArchiveTransfer);
    }
}
