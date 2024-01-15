<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade;

use FondOfImpala\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeBridge implements
    JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface
{
    /**
     * @var \FondOfImpala\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacade;

    /**
     * @param \FondOfImpala\Zed\CompanyUserReference\Business\CompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     */
    public function __construct(CompanyUserReferenceFacadeInterface $companyUserReferenceFacade)
    {
        $this->companyUserReferenceFacade = $companyUserReferenceFacade;
    }

    /**
     * @param string $companyUserReference
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByCompanyUserReference(
        string $companyUserReference
    ): ?CompanyBusinessUnitTransfer {
        return $this->companyUserReferenceFacade->getCompanyBusinessUnitByCompanyUserReference($companyUserReference);
    }
}
