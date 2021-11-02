<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister;

use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCartCodeTypeRestrictionsPersister implements
    ProductAbstractCartCodeTypeRestrictionsPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductCartCodeTypeRestrictionRepositoryInterface $repository,
        ProductCartCodeTypeRestrictionEntityManagerInterface $entityManager
    ) {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persist(ProductAbstractTransfer $productAbstractTransfer): void
    {
        $idProductAbstract = $productAbstractTransfer->getIdProductAbstract();

        if ($idProductAbstract === null) {
            return;
        }

        $currentCartCodeTypeIds = $this->repository->findBlacklistedCartCodeTypeIdsByIdProductAbstract($idProductAbstract);
        $newCartCodeTypeIds = $productAbstractTransfer->getBlacklistedCartCodeTypeIds();

        $cartCodeTypeIdsToDelete = array_diff($currentCartCodeTypeIds, $newCartCodeTypeIds);
        $cartCodeTypeIdsToCreate = array_diff($newCartCodeTypeIds, $currentCartCodeTypeIds);

        if (count($cartCodeTypeIdsToDelete) > 0) {
            $this->delete($idProductAbstract, $cartCodeTypeIdsToDelete);
        }

        if (count($cartCodeTypeIdsToCreate) > 0) {
            $this->create($idProductAbstract, $cartCodeTypeIdsToCreate);
        }
    }

    /**
     * @param int $idProductAbstract
     * @param array $cartCodeTypeIds
     *
     * @return void
     */
    protected function delete(int $idProductAbstract, array $cartCodeTypeIds): void
    {
        $this->entityManager->deleteProductAbstractCartCodeTypeRestrictions(
            $idProductAbstract,
            $cartCodeTypeIds,
        );
    }

    /**
     * @param int $idProductAbstract
     * @param array $cartCodeTypeIds
     *
     * @return void
     */
    protected function create(int $idProductAbstract, array $cartCodeTypeIds): void
    {
        foreach ($cartCodeTypeIds as $idCartCodeType) {
            $productAbstractCartCodeTypeRestrictionTransfer = (new ProductAbstractCartCodeTypeRestrictionTransfer())
                ->setIdCartCodeType($idCartCodeType)
                ->setIdProductAbstract($idProductAbstract);

            $this->entityManager->createProductAbstractCartCodeTypeRestriction(
                $productAbstractCartCodeTypeRestrictionTransfer,
            );
        }
    }
}
