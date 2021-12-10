<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Reader;

use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface $repository
     */
    public function __construct(CustomerProductListConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getIdsByIdCustomer(int $idCustomer): array
    {
        return $this->repository->getProductListIdsByIdCustomer($idCustomer);
    }
}
