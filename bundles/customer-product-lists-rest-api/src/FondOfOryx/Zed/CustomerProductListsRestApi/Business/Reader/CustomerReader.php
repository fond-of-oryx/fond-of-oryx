<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader;

use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface;

class CustomerReader implements CustomerReaderInterface
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
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getIdsByIdProductList(int $idProductList): array
    {
        return $this->repository->getCustomerIdsByIdProductList($idProductList);
    }
}
