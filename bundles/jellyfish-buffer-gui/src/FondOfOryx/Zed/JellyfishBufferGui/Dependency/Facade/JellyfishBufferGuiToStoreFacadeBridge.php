<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

class JellyfishBufferGuiToStoreFacadeBridge implements JellyfishBufferGuiToStoreFacadeInterface
{
    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct($storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    /**
     * @return array<\Generated\Shared\Transfer\StoreTransfer>
     */
    public function getAllStores()
    {
        return $this->storeFacade->getAllStores();
    }

    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore()
    {
        return $this->storeFacade->getCurrentStore();
    }

    /**
     * @param int $idStore
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreById($idStore)
    {
        return $this->storeFacade->getStoreById($idStore);
    }

    /**
     * @param string $storeName
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreByName($storeName)
    {
        return $this->storeFacade->getStoreByName($storeName);
    }

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return array<\Generated\Shared\Transfer\StoreTransfer>
     */
    public function getStoresWithSharedPersistence(StoreTransfer $storeTransfer)
    {
        return $this->storeFacade->getStoresWithSharedPersistence($storeTransfer);
    }
}
