<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade;

use FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface;

class CompaniesRestApiToCompanyDeleterFacadeBridge implements CompaniesRestApiToCompanyDeleterFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface $companyDeleterFacade
     */
    public function __construct(CompanyDeleterFacadeInterface $companyDeleterFacade)
    {
        $this->facade = $companyDeleterFacade;
    }

    /**
     * @param int $companyId
     *
     * @return array
     */
    public function deleteCompany(int $companyId): array
    {
        return $this->facade->deleteCompany($companyId);
    }
}
