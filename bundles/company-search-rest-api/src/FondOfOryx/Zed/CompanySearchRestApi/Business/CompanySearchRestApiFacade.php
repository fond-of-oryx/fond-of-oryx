<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business;

use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanySearchRestApi\Business\CompanySearchRestApiBusinessFactory getFactory()
 */
class CompanySearchRestApiFacade extends AbstractFacade implements CompanySearchRestApiFacadeInterface
{
 /**
  * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
  *
  * @return \Generated\Shared\Transfer\CompanyListTransfer
  */
    public function findCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        return $this->getFactory()
            ->createCompanyReader()
            ->findByCompanyList($companyListTransfer);
    }
}
