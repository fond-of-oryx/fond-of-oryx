<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig getConfig()
 */
class GiftCardProductConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface
     */
    public function createGiftCardProductAbstractConfigurationWriter(): GiftCardProductAbstractConfigurationWriterInterface
    {
        return new GiftCardProductAbstractConfigurationWriter(
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface
     */
    public function createGiftCardProductConfigurationWriter(): GiftCardProductConfigurationWriterInterface
    {
        return new GiftCardProductConfigurationWriter(
            $this->getProductFacade(),
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface
     */
    protected function getProductFacade(): GiftCardProductConnectorToProductFacadeInterface
    {
        return $this->getProvidedDependency(GiftCardProductConnectorDependencyProvider::FACADE_PRODUCT);
    }
}
