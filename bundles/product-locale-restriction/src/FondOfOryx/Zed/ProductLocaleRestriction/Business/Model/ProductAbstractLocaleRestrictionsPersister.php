<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business\Model;

use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractLocaleRestrictionsPersister implements ProductAbstractLocaleRestrictionsPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductLocaleRestrictionRepositoryInterface $repository,
        ProductLocaleRestrictionEntityManagerInterface $entityManager
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

        $currentLocaleIds = $this->repository->findLocaleBlacklistIdsByIdProductAbstract($idProductAbstract);
        $newLocaleIds = $productAbstractTransfer->getBlacklistedLocaleIds();

        $localeIdsToDelete = array_diff($currentLocaleIds, $newLocaleIds);
        $localeIdsToCreate = array_diff($newLocaleIds, $currentLocaleIds);

        if (count($localeIdsToDelete) > 0) {
            $this->delete($idProductAbstract, $localeIdsToDelete);
        }

        if (count($localeIdsToCreate) > 0) {
            $this->create($idProductAbstract, $localeIdsToCreate);
        }
    }

    /**
     * @param int $idProductAbstract
     * @param array $idLocales
     *
     * @return void
     */
    protected function delete(int $idProductAbstract, array $idLocales): void
    {
        $this->entityManager->deleteProductAbstractLocaleRestrictions(
            $idProductAbstract,
            $idLocales
        );
    }

    /**
     * @param int $idProductAbstract
     * @param array $idLocales
     *
     * @return void
     */
    protected function create(int $idProductAbstract, array $idLocales): void
    {
        foreach ($idLocales as $idLocale) {
            $productAbstractLocaleRestrictionTransfer = (new ProductAbstractLocaleRestrictionTransfer())
                ->setIdLocale($idLocale)
                ->setIdProductAbstract($idProductAbstract);

            $this->entityManager->createProductAbstractLocaleRestriction($productAbstractLocaleRestrictionTransfer);
        }
    }
}
