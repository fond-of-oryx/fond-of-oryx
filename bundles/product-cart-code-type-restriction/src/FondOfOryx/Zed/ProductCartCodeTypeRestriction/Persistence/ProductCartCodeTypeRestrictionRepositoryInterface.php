<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

interface ProductCartCodeTypeRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\CartCodeTypeTransfer[]
     */
    public function findBlacklistedCartCodeTypeByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return int[]
     */
    public function findBlacklistedCartCodeTypeIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param string[] $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCartCodeTypesByProductConcreteSkus(
        array $productConcreteSkus
    ): array;
}
