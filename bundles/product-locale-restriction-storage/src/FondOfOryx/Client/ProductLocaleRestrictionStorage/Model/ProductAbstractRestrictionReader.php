<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Model;

use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface;

class ProductAbstractRestrictionReader implements ProductAbstractRestrictionReaderInterface
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface
     */
    protected $localeClient;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReaderInterface
     */
    protected $productAbstractLocaleRestrictionStorageReader;

    /**
     * @param \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface $localeClient
     * @param \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReaderInterface $productAbstractLocaleRestrictionStorageReader
     */
    public function __construct(
        ProductLocaleRestrictionStorageToLocaleClientInterface $localeClient,
        ProductAbstractLocaleRestrictionStorageReaderInterface $productAbstractLocaleRestrictionStorageReader
    ) {
        $this->localeClient = $localeClient;
        $this->productAbstractLocaleRestrictionStorageReader = $productAbstractLocaleRestrictionStorageReader;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return bool
     */
    public function isRestricted(int $idProductAbstract): bool
    {
        $currentLocale = $this->localeClient->getCurrentLocale();
        $productAbstractLocaleRestrictionStorageTransfer = $this->productAbstractLocaleRestrictionStorageReader
            ->getByIdProductAbstract($idProductAbstract);

        if ($productAbstractLocaleRestrictionStorageTransfer === null) {
            return false;
        }

        $blacklistedLocales = $productAbstractLocaleRestrictionStorageTransfer->getBlacklistedLocales();

        return in_array($currentLocale, $blacklistedLocales);
    }
}
