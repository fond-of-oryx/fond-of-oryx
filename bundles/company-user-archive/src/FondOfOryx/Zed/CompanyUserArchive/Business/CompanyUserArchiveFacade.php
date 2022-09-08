<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business;

use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyUserArchive\Business\CompanyUserArchiveBusinessFactory getFactory()
 */
class CompanyUserArchiveFacade extends AbstractFacade implements CompanyUserArchiveFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    public function createCompanyUserArchive(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer
    ): CompanyUserArchiveTransfer {
        return $this->getFactory()
            ->createCompanyUserArchiveWriter()
            ->createCompanyUserArchive($companyUserArchiveTransfer);
    }
}
