<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Generated\Shared\Transfer\CategoryCollectionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface;

class JellyfishCrossEngageToProductCategoryFacadeBridge implements JellyfishCrossEngageToProductCategoryFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface
     */
    protected $productCategoryFacade;

    /**
     * @param \Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface $productCategoryFacade
     */
    public function __construct(ProductCategoryFacadeInterface $productCategoryFacade)
    {
        $this->productCategoryFacade = $productCategoryFacade;
    }

    /**
     * @param int $idProductAbstract
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\CategoryCollectionTransfer
     */
    public function getCategoryTransferCollectionByIdProductAbstract(
        int $idProductAbstract,
        LocaleTransfer $localeTransfer
    ): CategoryCollectionTransfer {
        return $this->productCategoryFacade->getCategoryTransferCollectionByIdProductAbstract($idProductAbstract, $localeTransfer);
    }
}
