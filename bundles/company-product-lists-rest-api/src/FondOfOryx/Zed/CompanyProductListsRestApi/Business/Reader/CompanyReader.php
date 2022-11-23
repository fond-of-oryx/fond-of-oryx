<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader;

use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface;

class CompanyReader implements CompanyReaderInterface
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
     * @param int $idProductList
     *
     * @return array<int>
     */
    public function getIdsByIdProductList(int $idProductList): array
    {
        return $this->repository->getCompanyIdsByIdProductList($idProductList);
    }
}
