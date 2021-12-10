<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Persister;

use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListRelationPersister implements CustomerProductListRelationPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface
     */
    protected $productListReader;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        CustomerProductListConnectorEntityManagerInterface $entityManager
    ) {
        $this->productListReader = $productListReader;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CustomerProductListRelationTransfer $customerProductListRelationTransfer): void
    {
        $idCustomer = $customerProductListRelationTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return;
        }

        $newProductListIds = $customerProductListRelationTransfer->getProductListIds();
        $currentProductListIds = $this->productListReader->getIdsByIdCustomer($idCustomer);

        $productListIdsToAssign = array_diff($newProductListIds, $currentProductListIds);
        $productListIdsToDeAssign = array_diff($currentProductListIds, $newProductListIds);

        if (count($productListIdsToAssign) > 0) {
            $this->entityManager->assignProductListsToCustomer($productListIdsToAssign, $idCustomer);
        }

        if (count($productListIdsToDeAssign) > 0) {
            $this->entityManager->deAssignProductListsFromCustomer($productListIdsToDeAssign, $idCustomer);
        }
    }
}
