<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Model;

interface ProductAbstractRestrictionReaderInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return bool
     */
    public function isRestricted(int $idProductAbstract): bool;
}
