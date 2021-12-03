<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Reader;

use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface $repository
     */
    public function __construct(CompanyProductListConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getIdsByIdCompany(int $idCompany): array
    {
        return $this->repository->getProductListIdsByIdCompany($idCompany);
    }
}
