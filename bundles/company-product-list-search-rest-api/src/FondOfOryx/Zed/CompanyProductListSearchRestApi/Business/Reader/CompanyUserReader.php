<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected IdCustomerFilterInterface $idCustomerFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface
     */
    protected CompanyUuidFilterInterface $companyUuidFilter;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface
     */
    protected CompanyProductListSearchRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface $idCustomerFilter
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface $companyUuidFilter
     * @param \FondOfOryx\Zed\CompanyProductListSearchRestApi\Persistence\CompanyProductListSearchRestApiRepositoryInterface $repository
     */
    public function __construct(
        IdCustomerFilterInterface $idCustomerFilter,
        CompanyUuidFilterInterface $companyUuidFilter,
        CompanyProductListSearchRestApiRepositoryInterface $repository
    ) {
        $this->idCustomerFilter = $idCustomerFilter;
        $this->companyUuidFilter = $companyUuidFilter;
        $this->repository = $repository;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return int|null
     */
    public function getIdByFilterFields(array $filterFieldTransfers): ?int
    {
        $idCustomer = $this->idCustomerFilter->filter($filterFieldTransfers);

        if ($idCustomer === null) {
            return null;
        }

        $companyUuid = $this->companyUuidFilter->filter($filterFieldTransfers);

        if ($companyUuid === null) {
            return null;
        }

        return $this->repository->getIdCompanyUserByIdCustomerAndCompanyUuid($idCustomer, $companyUuid);
    }
}
