<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

interface ProductLocaleRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\LocaleTransfer>
     */
    public function findBlacklistedLocaleByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedLocaleIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductAbstractIds(
        array $idProductAbstracts
    ): array;

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedLocalesByProductConcreteSkus(
        array $productConcreteSkus
    ): array;
}
