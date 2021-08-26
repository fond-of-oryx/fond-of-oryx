<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business;

use FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilter;
use FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductAbstractConfigurationWriterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriter;
use FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard\GiftCardProductConfigurationWriterInterface;
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
            $this->createGiftCardAmountFilter(),
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
            $this->createGiftCardAmountFilter(),
            $this->getEntityManager(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface
     */
    protected function createGiftCardAmountFilter(): GiftCardAmountFilterInterface
    {
        return new GiftCardAmountFilter();
    }
}
