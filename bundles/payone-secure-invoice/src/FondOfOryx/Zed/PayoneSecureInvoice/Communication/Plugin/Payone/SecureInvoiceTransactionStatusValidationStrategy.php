<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Communication\Plugin\Payone;

use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface;
use SprykerEco\Zed\Payone\Dependency\Plugin\TransactionStatusValidationStrategyInterface;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Business\PayoneSecureInvoiceFacade getFacade()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig getConfig()
 */
class SecureInvoiceTransactionStatusValidationStrategy extends AbstractPlugin implements TransactionStatusValidationStrategyInterface
{
    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse|bool
     */
    public function validate(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer)
    {
        return $this->getFacade()->validateTransactionStatus($request, $standardParameterTransfer);
    }
}
