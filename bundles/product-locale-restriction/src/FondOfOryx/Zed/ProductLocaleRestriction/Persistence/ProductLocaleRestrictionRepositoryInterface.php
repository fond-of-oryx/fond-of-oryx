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

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findLocaleBlacklistIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int[] $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedLocaleIdsByProductAbstractIds(
        array $idProductAbstracts
    ): array;
}
