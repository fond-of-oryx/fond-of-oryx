<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractPaymentRestrictionsPersister implements ProductAbstractPaymentRestrictionsPersisterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManagerInterface $entityManager
     */
    public function __construct(
        ProductPaymentRestrictionRepositoryInterface $repository,
        ProductPaymentRestrictionEntityManagerInterface $entityManager
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

        $currentPaymentIds = $this->repository->findBlacklistedPaymentMethodIdsByIdProductAbstract($idProductAbstract);
        $newPaymentIds = $productAbstractTransfer->getBlacklistedPaymentMethodIds();

        $paymentMethodIdsToDelete = array_diff($currentPaymentIds, $newPaymentIds);
        $paymentMethodIdsToCreate = array_diff($newPaymentIds, $currentPaymentIds);

        if (count($paymentMethodIdsToDelete) > 0) {
            $this->delete($idProductAbstract, $paymentMethodIdsToDelete);
        }

        if (count($paymentMethodIdsToCreate) > 0) {
            $this->create($idProductAbstract, $paymentMethodIdsToCreate);
        }
    }

    /**
     * @param int $idProductAbstract
     * @param array $idPaymentMethods
     *
     * @return void
     */
    protected function delete(int $idProductAbstract, array $idPaymentMethods): void
    {
        $this->entityManager->deleteProductAbstractPaymentRestrictions(
            $idProductAbstract,
            $idPaymentMethods,
        );
    }

    /**
     * @param int $idProductAbstract
     * @param array $idPaymentMethods
     *
     * @return void
     */
    protected function create(int $idProductAbstract, array $idPaymentMethods): void
    {
        foreach ($idPaymentMethods as $idPayment) {
            $productAbstractPaymentRestrictionTransfer = (new ProductAbstractPaymentRestrictionTransfer())
                ->setIdPaymentMethod($idPayment)
                ->setIdProductAbstract($idProductAbstract);

            $this->entityManager->createProductAbstractPaymentRestriction($productAbstractPaymentRestrictionTransfer);
        }
    }
}
