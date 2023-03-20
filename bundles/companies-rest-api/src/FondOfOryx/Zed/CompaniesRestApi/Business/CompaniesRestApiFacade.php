<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory getFactory()
 */
class CompaniesRestApiFacade extends AbstractFacade implements CompaniesRestApiFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer
    {
        return $this->getFactory()
            ->createCompanyDeleter()
            ->deleteCompanies($companyCollectionTransfer);
    }
}
