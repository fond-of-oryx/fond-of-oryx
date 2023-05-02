<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader;

use FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class StoreReader implements StoreReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface
     */
    protected FallbackLocaleMailProxyToStoreFacadeInterface $storeFacade;

    /**
     * @param \FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface $storeFacade
     */
    public function __construct(FallbackLocaleMailProxyToStoreFacadeInterface $storeFacade)
    {
        $this->storeFacade = $storeFacade;
    }

    /**
     * @inheritDoc
     */
    public function getByMail(MailTransfer $mailTransfer): StoreTransfer
    {
        $storeName = $mailTransfer->getStoreName();

        if ($storeName === null) {
            return $this->storeFacade->getCurrentStore();
        }

        return $this->storeFacade->getStoreByName($storeName);
    }
}
