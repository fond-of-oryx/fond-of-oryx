<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business;

use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpander;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpanderInterface;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReader;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface;
use FondOfOryx\Zed\FallbackLocaleMailProxy\FallbackLocaleMailProxyDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class FallbackLocaleMailProxyBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpanderInterface
     */
    public function createMailExpander(): MailExpanderInterface
    {
        return new MailExpander(
            $this->createStoreReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface
     */
    protected function createStoreReader(): StoreReaderInterface
    {
        return new StoreReader(
            $this->getStoreFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\FallbackLocaleMailProxy\Dependency\Facade\FallbackLocaleMailProxyToStoreFacadeInterface
     */
    protected function getStoreFacade(): FallbackLocaleMailProxyToStoreFacadeInterface
    {
        return $this->getProvidedDependency(FallbackLocaleMailProxyDependencyProvider::FACADE_STORE);
    }
}
