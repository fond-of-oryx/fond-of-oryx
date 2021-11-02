<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCountryRestrictionsPersister implements ProductAbstractCountryRestrictionsPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductCountryRestrictionRepositoryInterface $repository,
        ProductCountryRestrictionEntityManagerInterface $entityManager
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

        $currentCountryIds = $this->repository->findBlacklistedCountryIdsByIdProductAbstract($idProductAbstract);
        $newCountryIds = $productAbstractTransfer->getBlacklistedCountryIds();

        $countryIdsToDelete = array_diff($currentCountryIds, $newCountryIds);
        $countryIdsToCreate = array_diff($newCountryIds, $currentCountryIds);

        if (count($countryIdsToDelete) > 0) {
            $this->delete($idProductAbstract, $countryIdsToDelete);
        }

        if (count($countryIdsToCreate) > 0) {
            $this->create($idProductAbstract, $countryIdsToCreate);
        }
    }

    /**
     * @param int $idProductAbstract
     * @param array $countryIds
     *
     * @return void
     */
    protected function delete(int $idProductAbstract, array $countryIds): void
    {
        $this->entityManager->deleteProductAbstractCountryRestrictions(
            $idProductAbstract,
            $countryIds,
        );
    }

    /**
     * @param int $idProductAbstract
     * @param array $countryIds
     *
     * @return void
     */
    protected function create(int $idProductAbstract, array $countryIds): void
    {
        foreach ($countryIds as $idCountry) {
            $productAbstractCountryRestrictionTransfer = (new ProductAbstractCountryRestrictionTransfer())
                ->setIdCountry($idCountry)
                ->setIdProductAbstract($idProductAbstract);

            $this->entityManager->createProductAbstractCountryRestriction($productAbstractCountryRestrictionTransfer);
        }
    }
}
