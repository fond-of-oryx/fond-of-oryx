<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

use ArrayObject;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpander implements ProductAbstractExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface $repository
     */
    public function __construct(ProductCountryRestrictionRepositoryInterface $repository)
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

        $blacklistedCountries = $this->repository->findBlacklistedCountryByIdProductAbstract($idProductAbstract);
        $blacklistedCountryIds = [];

        foreach ($blacklistedCountries as $blacklistedCountry) {
            $blacklistedCountryIds[] = $blacklistedCountry->getIdCountry();
        }

        return $productAbstractTransfer->setBlacklistedCountries(new ArrayObject($blacklistedCountries))
            ->setBlacklistedCountryIds($blacklistedCountryIds);
    }
}
