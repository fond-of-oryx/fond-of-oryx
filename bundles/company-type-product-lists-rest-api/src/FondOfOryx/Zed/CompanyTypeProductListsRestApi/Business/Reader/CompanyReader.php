<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface $repository
     */
    public function __construct(CompanyTypeProductListsRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<int> $companyUserIds
     *
     * @return array<string>
     */
    public function getWhitelistedUuidsByCompanyUserIds(array $companyUserIds): array
    {
        return $this->repository->getWhitelistedCompanyUuidsByCompanyUserIds($companyUserIds);
    }
}
