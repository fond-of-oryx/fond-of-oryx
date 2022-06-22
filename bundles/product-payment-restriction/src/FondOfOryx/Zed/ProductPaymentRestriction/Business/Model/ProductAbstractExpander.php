<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

use ArrayObject;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpander implements ProductAbstractExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface $repository
     */
    public function __construct(ProductPaymentRestrictionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expand(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        $idProductAbstract = $productAbstractTransfer->getIdProductAbstract();

        if ($idProductAbstract === null) {
            return $productAbstractTransfer;
        }

        $blacklistedPayments = $this->repository->findBlacklistedPaymentMethodsByIdsProductAbstract([$idProductAbstract]);
        $blacklistedPaymentIds = [];

        foreach ($blacklistedPayments as $paymentMethodTransfer) {
            $blacklistedPaymentIds[] = $paymentMethodTransfer->getIdPaymentMethod();
        }

        return $productAbstractTransfer->setBlacklistedPaymentMethods(new ArrayObject($blacklistedPayments))
            ->setBlacklistedPaymentMethodIds($blacklistedPaymentIds);
    }
}
