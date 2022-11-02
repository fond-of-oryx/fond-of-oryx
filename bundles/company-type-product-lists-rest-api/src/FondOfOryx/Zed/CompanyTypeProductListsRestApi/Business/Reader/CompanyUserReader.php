<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Persistence\CompanyTypeProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyUserReader implements CompanyUserReaderInterface
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
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return array<int>
     */
    public function getAuthorizedIdsByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): array {
        $idCustomer = $restProductListUpdateRequestTransfer->getIdCustomer();
        $restProductListsAttributesTransfer = $restProductListUpdateRequestTransfer->getProductList();
        $activeIds = [];

        if ($idCustomer === null || $restProductListsAttributesTransfer === null) {
            return $activeIds;
        }

        $customerReferences = array_merge(
            $restProductListsAttributesTransfer->getCustomerIdsToAssign(),
            $restProductListsAttributesTransfer->getCustomerIdsToDeassign(),
        );

        if (count($customerReferences) > 0) {
            $activeIds = $this->repository->getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCustomerReferences(
                $idCustomer,
                $customerReferences,
            );
        }

        $companyUuids = array_merge(
            $restProductListsAttributesTransfer->getCompanyIdsToAssign(),
            $restProductListsAttributesTransfer->getCompanyIdsToDeassign(),
        );

        if (count($companyUuids) < 1) {
            return $activeIds;
        }

        return array_merge(
            $activeIds,
            $this->repository->getAuthorizedCompanyUserIdsByCurrentIdCustomerAndCompanyUuids(
                $idCustomer,
                $customerReferences,
            ),
        );
    }
}
