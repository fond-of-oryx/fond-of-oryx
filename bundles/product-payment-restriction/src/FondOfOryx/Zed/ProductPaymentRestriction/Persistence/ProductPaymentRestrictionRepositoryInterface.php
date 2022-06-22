<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

interface ProductPaymentRestrictionRepositoryInterface
{
    /**
     * @param array<int> $idProductAbstracts
     *
     * @return array<\Generated\Shared\Transfer\PaymentMethodTransfer>
     */
    public function findBlacklistedPaymentMethodsByIdsProductAbstract(
        array $idProductAbstracts
    ): array;

    /**
     * @param int $idProductAbstract
     *
     * @return array<int>
     */
    public function findBlacklistedPaymentMethodIdsByIdProductAbstract(int $idProductAbstract): array;
}
