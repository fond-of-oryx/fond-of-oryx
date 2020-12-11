<?php

namespace FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface;

class ErpOrderToCompanyUserFacadeBridge implements ErpOrderToCompanyUserFacadeInterface
{
    /**
     * @var \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface $facade
     */
    public function __construct(CompanyUserFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param int $idCompanyUser
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    public function getCompanyUserById(int $idCompanyUser): CompanyUserTransfer
    {
        return $this->facade->getCompanyUserById($idCompanyUser);
    }
}
