<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter;

use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class DeassignableCompanyIdsFilter implements CompanyIdsFilterInterface
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

        $companyUuidsToDeassign = $restProductListsAttributesTransfer->getCompanyIdsToDeassign();

        if (count($companyUuidsToDeassign) <= 0) {
            return [];
        }

        $companyIdsToDeassign = $this->repository->getCompanyIdsByCompanyUuidsAndIdCustomer(
            $companyUuidsToDeassign,
            $idCustomer,
        );

        if (count($companyIdsToDeassign) <= 0) {
            return [];
        }

        return array_values(
            array_intersect(
                $companyIdsToDeassign,
                $assignedCompanyIds,
            ),
        );
    }
}
