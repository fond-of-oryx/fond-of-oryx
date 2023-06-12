<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader;

use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected IdCustomerFilterInterface $idCustomerFilter;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface
     */
    protected CustomerProductListSearchRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface $idCustomerFilter
     * @param \FondOfOryx\Zed\CustomerProductListSearchRestApi\Persistence\CustomerProductListSearchRestApiRepositoryInterface $repository
     */
    public function __construct(
        IdCustomerFilterInterface $idCustomerFilter,
        CustomerProductListSearchRestApiRepositoryInterface $repository
    ) {
        $this->idCustomerFilter = $idCustomerFilter;
        $this->repository = $repository;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return array<int>
     */
    public function getIdsByFilterFields(array $filterFieldTransfers): array
    {
        $idCustomer = $this->idCustomerFilter->filter($filterFieldTransfers);

        if ($idCustomer === null) {
            return [];
        }

        return $this->repository->getProductListIdsByIdCustomer($idCustomer);
    }
}
