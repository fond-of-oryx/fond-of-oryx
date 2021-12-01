<?php

namespace FondOfOryx\Zed\CompanyCompanyUserGui\Communication\Form\DataProvider;

use FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface;

class CompanyUserCompanyFormDataProvider
{
    /**
     * @var \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyCompanyUserGui\Persistence\CompanyCompanyUserGuiRepositoryInterface $repository
     */
    public function __construct(CompanyCompanyUserGuiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|null $idCompany
     *
     * @return array<string, int>
     */
    public function getOptions(?int $idCompany): array
    {
        if (!$idCompany) {
            return [];
        }

        $companyTransfer = $this->repository->getByIdCompany($idCompany);

        if ($companyTransfer) {
            return [$companyTransfer->getName() => $idCompany];
        }

        return [];
    }
}
