<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReader;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReaderInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReader;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReaderInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductLocaleRestrictionStorageFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReaderInterface
     */
    public function createProductAbstractRestrictionReader(): ProductAbstractRestrictionReaderInterface
    {
        return new ProductAbstractRestrictionReader(
            $this->getLocaleClient(),
            $this->createProductAbstractLocaleRestrictionStorageReader()
        );
    }

    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReaderInterface
     */
    protected function createProductAbstractLocaleRestrictionStorageReader(): ProductAbstractLocaleRestrictionStorageReaderInterface
    {
        return new ProductAbstractLocaleRestrictionStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService()
        );
    }

    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface
     */
    protected function getStorageClient(): ProductLocaleRestrictionStorageToStorageClientInterface
    {
        return $this->getProvidedDependency(ProductLocaleRestrictionStorageDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface
     */
    protected function getLocaleClient(): ProductLocaleRestrictionStorageToLocaleClientInterface
    {
        return $this->getProvidedDependency(ProductLocaleRestrictionStorageDependencyProvider::CLIENT_LOCALE);
    }

    /**
     * @return \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface
     */
    protected function getSynchronizationService(): ProductLocaleRestrictionStorageToSynchronizationServiceInterface
    {
        return $this->getProvidedDependency(ProductLocaleRestrictionStorageDependencyProvider::SERVICE_SYNCHRONIZATION);
    }
}
