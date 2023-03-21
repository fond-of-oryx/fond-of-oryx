<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompaniesRestApi\Business\CompaniesRestApiBusinessFactory getFactory()
 */
class CompaniesRestApiFacade extends AbstractFacade implements CompaniesRestApiFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->getFactory()
            ->createCompanyDeleter()
            ->deleteCompany($companyTransfer);
    }
}
