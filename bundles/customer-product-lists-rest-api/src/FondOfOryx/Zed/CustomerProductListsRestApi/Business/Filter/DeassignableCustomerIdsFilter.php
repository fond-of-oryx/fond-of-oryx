<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter;

use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

class DeassignableCustomerIdsFilter implements CustomerIdsFilterInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface $repository
     */
    public function __construct(CustomerProductListsRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array<int> $assignedCustomerIds
     * @param \Generated\Shared\Transfer\RestProductListsAttributesTransfer $restProductListsAttributesTransfer
     *
     * @return array<int>
     */
    public function filter(
        array $assignedCustomerIds,
        RestProductListsAttributesTransfer $restProductListsAttributesTransfer
    ): array {
        $customerReferencesToDeassign = $restProductListsAttributesTransfer->getCustomerIdsToDeassign();

        if (count($customerReferencesToDeassign) <= 0) {
            return [];
        }

        $customerIdsToDeassign = $this->repository->getCustomerIdsByCustomerReferences(
            $customerReferencesToDeassign,
        );

        if (count($customerIdsToDeassign) <= 0) {
            return [];
        }

        return array_values(
            array_intersect(
                $customerIdsToDeassign,
                $assignedCustomerIds,
            ),
        );
    }
}
