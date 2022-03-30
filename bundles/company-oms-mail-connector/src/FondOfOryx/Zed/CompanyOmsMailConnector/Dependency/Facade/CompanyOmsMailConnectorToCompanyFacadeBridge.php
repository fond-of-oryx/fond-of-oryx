<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Company\Business\CompanyFacadeInterface;

class CompanyOmsMailConnectorToCompanyFacadeBridge implements CompanyOmsMailConnectorToCompanyFacadeInterface
{
    /**
     * @var \Spryker\Zed\Company\Business\CompanyFacadeInterface
     */
    protected $facade;

    /**
     * @param \Spryker\Zed\Company\Business\CompanyFacadeInterface $companyFacade
     */
    public function __construct(CompanyFacadeInterface $companyFacade)
    {
        $this->facade = $companyFacade;
    }

    /**
     * Specification:
     * - Finds a company by id.
     * - Returns null if company does not exist.
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function findCompanyById(int $idCompany): ?CompanyTransfer
    {
        return $this->facade->findCompanyById($idCompany);
    }
}
