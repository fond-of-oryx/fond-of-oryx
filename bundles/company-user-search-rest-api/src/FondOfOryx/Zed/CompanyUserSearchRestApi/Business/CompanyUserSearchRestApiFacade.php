<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApi\Business;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyUserSearchRestApi\Business\CompanyUserSearchRestApiBusinessFactory getFactory()
 */
class CompanyUserSearchRestApiFacade extends AbstractFacade implements CompanyUserSearchRestApiFacadeInterface
{
 /**
  * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
  *
  * @return \Generated\Shared\Transfer\CompanyUserListTransfer
  */
    public function findCompanyUsers(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        return $this->getFactory()
            ->createCompanyUserReader()
            ->findByCompanyUserList($companyUserListTransfer);
    }
}
