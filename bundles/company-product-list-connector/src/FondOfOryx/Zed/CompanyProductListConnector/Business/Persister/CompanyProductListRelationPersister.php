<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Persister;

use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListRelationPersister implements CompanyProductListRelationPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface
     */
    protected $productListReader;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        CompanyProductListConnectorEntityManagerInterface $entityManager
    ) {
        $this->productListReader = $productListReader;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CompanyProductListRelationTransfer $companyProductListRelationTransfer): void
    {
        $idCompany = $companyProductListRelationTransfer->getIdCompany();

        if ($companyProductListRelationTransfer->getIdCompany() === null) {
            return;
        }

        $newProductListIds = $companyProductListRelationTransfer->getProductListIds();
        $currentProductListIds = $this->productListReader->getIdsByIdCompany($idCompany);

        $productListIdsToAssign = array_diff($newProductListIds, $currentProductListIds);
        $productListIdsToDeAssign = array_diff($currentProductListIds, $newProductListIds);

        if (count($productListIdsToAssign) > 0) {
            $this->entityManager->assignProductListsToCompany($productListIdsToAssign, $idCompany);
        }

        if (count($productListIdsToDeAssign) > 0) {
            $this->entityManager->deAssignProductListsFromCompany($productListIdsToDeAssign, $idCompany);
        }
    }
}
