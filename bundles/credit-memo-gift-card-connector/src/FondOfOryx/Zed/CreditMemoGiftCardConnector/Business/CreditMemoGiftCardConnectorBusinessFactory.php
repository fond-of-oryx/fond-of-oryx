<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriter;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriter;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\CreditMemoGiftCardConnectorConfig getConfig()
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorRepository getRepository()
 */
class CreditMemoGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriterInterface
     */
    public function createCreditMemoGiftCardWriter(): CreditMemoGiftCardWriterInterface
    {
        return new CreditMemoGiftCardWriter(
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface
     */
    public function createCreditMemoGiftCardsWriter(): CreditMemoGiftCardsWriterInterface
    {
        return new CreditMemoGiftCardsWriter(
            $this->createCreditMemoGiftCardWriter(),
        );
    }
}
