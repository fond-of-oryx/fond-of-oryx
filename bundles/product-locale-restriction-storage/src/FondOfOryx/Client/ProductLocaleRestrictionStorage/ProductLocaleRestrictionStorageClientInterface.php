<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

interface ProductLocaleRestrictionStorageClientInterface
{
    /**
     * Specification:
     * - Checks if product abstract is restricted.
     *
     * @api
     *
     * @param int $idProductAbstract
     *
     * @return bool
     */
    public function isProductAbstractRestricted(int $idProductAbstract): bool;
}
