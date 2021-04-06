<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business\Model;

use ArrayObject;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpander implements ProductAbstractExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface $repository
     */
    public function __construct(ProductLocaleRestrictionRepositoryInterface $repository)
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

        if ($productAbstractTransfer->getIdProductAbstract() === null) {
            return $productAbstractTransfer;
        }

        $blacklistedLocales = $this->repository->findBlacklistedLocaleByIdProductAbstract($idProductAbstract);
        $blacklistedLocaleIds = [];

        foreach ($blacklistedLocales as $blacklistedLocale) {
            $blacklistedLocaleIds[] = $blacklistedLocale->getIdLocale();
        }

        return $productAbstractTransfer->setBlacklistedLocales(new ArrayObject($blacklistedLocales))
            ->setBlacklistedLocaleIds($blacklistedLocaleIds);
    }
}
