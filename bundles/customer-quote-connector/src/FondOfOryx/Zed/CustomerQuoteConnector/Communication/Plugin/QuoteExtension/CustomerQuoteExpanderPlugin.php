<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Communication\Plugin\QuoteExtension;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Throwable;

/**
 * @method \FondOfOryx\Zed\CustomerQuoteConnector\Persistence\CustomerQuoteConnectorRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerQuoteConnector\Communication\CustomerQuoteConnectorCommunicationFactory getFactory()
 */
class CustomerQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * @var array<string, \Generated\Shared\Transfer\CustomerTransfer>
     */
    protected static array $cacheCustomerTransfers = [];

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $customerTransfer = $quoteTransfer->getCustomer();
        $customerReference = $quoteTransfer->getCustomerReference();

        if ($customerTransfer !== null || $customerReference === null) {
            return $quoteTransfer;
        }

        if (array_key_exists($customerReference, static::$cacheCustomerTransfers)) {
            return $quoteTransfer->setCustomer(static::$cacheCustomerTransfers[$customerReference]);
        }

        $idCustomer = $this->getRepository()->getIdCustomerByCustomerReference($customerReference);

        if ($idCustomer === null) {
            return $quoteTransfer;
        }

        try {
            $customerTransferToSearch = (new CustomerTransfer())->setIdCustomer($idCustomer);
            static::$cacheCustomerTransfers[$customerReference] = $this->getFactory()
                ->getCustomerFacade()
                ->getCustomer($customerTransferToSearch);

            $quoteTransfer->setCustomer(static::$cacheCustomerTransfers[$customerReference]);
        } catch (Throwable) {
        }

        return $quoteTransfer;
    }
}
