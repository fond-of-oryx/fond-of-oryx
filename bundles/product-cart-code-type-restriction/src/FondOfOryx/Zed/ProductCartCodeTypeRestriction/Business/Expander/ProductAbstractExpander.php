<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander;

use ArrayObject;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpander implements ProductAbstractExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface $repository
     */
    public function __construct(ProductCartCodeTypeRestrictionRepositoryInterface $repository)
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

        $blacklistedCartCodeTypes = $this->repository->findBlacklistedCartCodeTypeByIdProductAbstract($idProductAbstract);
        $blacklistedCartCodeTypeIds = [];

        foreach ($blacklistedCartCodeTypes as $blacklistedCartCodeType) {
            $blacklistedCartCodeTypeIds[] = $blacklistedCartCodeType->getIdCartCodeType();
        }

        return $productAbstractTransfer->setBlacklistedCartCodeTypes(new ArrayObject($blacklistedCartCodeTypes))
            ->setBlacklistedCartCodeTypeIds($blacklistedCartCodeTypeIds);
    }
}
