<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageFactory getFactory()
 */
class ProductLocaleRestrictionStorageClient extends AbstractClient implements ProductLocaleRestrictionStorageClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductAbstract
     *
     * @return bool
     */
    public function isProductAbstractRestricted(int $idProductAbstract): bool
    {
        return $this->getFactory()->createProductAbstractRestrictionReader()->isRestricted($idProductAbstract);
    }
}
