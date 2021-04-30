<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionBusinessFactory getFactory()
 */
class ProductCountryRestrictionFacade extends AbstractFacade implements ProductCountryRestrictionFacadeInterface
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
    public function persistProductAbstractCountryRestrictions(ProductAbstractTransfer $productAbstractTransfer): void
    {
        $this->getFactory()->createProductAbstractCountryRestrictionsPersister()->persist($productAbstractTransfer);
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
        return $this->getFactory()->createProductAbstractExpander()->expand($productAbstractTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCountriesByProductConcreteSkus(array $productConcreteSkus): array
    {
        return $this->getRepository()->findBlacklistedCountriesByProductConcreteSkus($productConcreteSkus);
    }
}
