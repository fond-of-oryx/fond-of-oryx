<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

interface ProductPaymentRestrictionRepositoryInterface
{
    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array
     */
    public function findBlacklistedPaymentMethodsByIdsProductAbstract(
        array $idProductAbstracts
    ): array;
}
