<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter;

use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class AssignableCompanyIdsFilter implements CompanyIdsFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface $repository
     */
    public function __construct(CompanyProductListsRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<int> $assignedCompanyIds
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return array<int>
     */
    public function filter(
        array $assignedCompanyIds,
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): array {
        $idCustomer = $restProductListUpdateRequestTransfer->getIdCustomer();
        $restProductListsAttributesTransfer = $restProductListUpdateRequestTransfer->getProductList();

        if ($idCustomer === null || $restProductListsAttributesTransfer === null) {
            return [];
        }

        $companyUuidsToAssign = $restProductListsAttributesTransfer->getCompanyIdsToAssign();

        if (count($companyUuidsToAssign) <= 0) {
            return [];
        }

        $companyIdsToAssign = $this->repository->getCompanyIdsByCompanyUuidsAndIdCustomer(
            $companyUuidsToAssign,
            $idCustomer,
        );

        if (count($companyIdsToAssign) <= 0) {
            return [];
        }

        return array_values(
            array_diff(
                $companyIdsToAssign,
                $assignedCompanyIds,
            ),
        );
    }
}
