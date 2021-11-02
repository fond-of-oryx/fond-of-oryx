<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

interface ProductCartCodeTypeRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\CartCodeTypeTransfer>
     */
    public function findBlacklistedCartCodeTypeByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedCartCodeTypeIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCartCodeTypesByProductConcreteSkus(
        array $productConcreteSkus
    ): array;
}
