<?php

namespace FondOfOryx\Zed\CompanyUserSearchRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;

interface CompanyUserTransferPostMapExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser $spyCompanyUser
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function expand(CompanyUserTransfer $companyUserTransfer, SpyCompanyUser $spyCompanyUser): CompanyUserTransfer;
}
