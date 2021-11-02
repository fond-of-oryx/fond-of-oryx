<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionBusinessFactory getFactory()
 */
class ProductCartCodeTypeRestrictionFacade extends AbstractFacade implements ProductCartCodeTypeRestrictionFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persistProductAbstractCartCodeTypeRestrictions(ProductAbstractTransfer $productAbstractTransfer): void
    {
        $this->getFactory()
            ->createProductAbstractCartCodeTypeRestrictionsPersister()
            ->persist($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expandProductAbstract(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFactory()
            ->createProductAbstractExpander()
            ->expand($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array
    {
        return $this->getRepository()->findBlacklistedCartCodeTypesByProductConcreteSkus($productConcreteSkus);
    }
}
