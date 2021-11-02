<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence;

interface ProductCountryRestrictionRepositoryInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return array<\Generated\Shared\Transfer\CountryTransfer>
     */
    public function findBlacklistedCountryByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedCountryIdsByIdProductAbstract(
        int $idProductAbstract
    ): array;

    /**
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function findBlacklistedCountriesByProductConcreteSkus(
        array $productConcreteSkus
    ): array;
}
