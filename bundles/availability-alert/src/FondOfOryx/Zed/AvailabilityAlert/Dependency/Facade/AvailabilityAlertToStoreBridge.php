<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

class AvailabilityAlertToStoreBridge implements AvailabilityAlertToStoreInterface
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
     * @param string $store
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStore(string $store): StoreTransfer
    {
        return $this->storeFacade->getStoreByName($store);
    }
}
