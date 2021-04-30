<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

interface ProductLocaleRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer[]
     */
    public function findBlacklistedLocaleByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findBlacklistedLocaleIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int[] $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductAbstractIds(
        array $idProductAbstracts
    ): array;

    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductConcreteSkus(
        array $productConcreteSkus
    ): array;
}
