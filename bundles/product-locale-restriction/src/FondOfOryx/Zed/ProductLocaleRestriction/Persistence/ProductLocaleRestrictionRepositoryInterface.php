<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

interface ProductLocaleRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function findLocaleBlacklistByIdProductAbstract(
        int $idProductAbstract
    ): array;
}
