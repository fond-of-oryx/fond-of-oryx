<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Dependency\Client;

use Generated\Shared\Transfer\CategoryCollectionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

interface JellyfishCrossEngageToProductCategoryFacadeInterface
{
    /**
     * @param int $idProductAbstract
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\CategoryCollectionTransfer
     */
    public function getCategoryTransferCollectionByIdProductAbstract(
        int $idProductAbstract,
        LocaleTransfer $localeTransfer
    ): CategoryCollectionTransfer;
}
