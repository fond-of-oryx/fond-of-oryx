<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Plugin\ProductStorageExtension;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductAbstractRestrictionPluginInterface;

/**
 * @method \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageClientInterface getClient()
 */
class ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin extends AbstractPlugin implements ProductAbstractRestrictionPluginInterface
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
    public function isRestricted(int $idProductAbstract): bool
    {
        return $this->getClient()->isProductAbstractRestricted($idProductAbstract);
    }
}
