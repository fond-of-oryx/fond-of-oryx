<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;
use Spryker\Zed\Product\Business\ProductFacadeInterface;

class AvailabilityAlertToProductBridge implements AvailabilityAlertToProductInterface
{
    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     */
    public function __construct(ProductFacadeInterface $productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer|null
     */
    public function findProductAbstractById($idProductAbstract): ?ProductAbstractTransfer
    {
        return $this->productFacade->findProductAbstractById($idProductAbstract);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductUrlTransfer
     */
    public function getProductUrl(ProductAbstractTransfer $productAbstractTransfer): ProductUrlTransfer
    {
        return $this->productFacade->getProductUrl($productAbstractTransfer);
    }
}
