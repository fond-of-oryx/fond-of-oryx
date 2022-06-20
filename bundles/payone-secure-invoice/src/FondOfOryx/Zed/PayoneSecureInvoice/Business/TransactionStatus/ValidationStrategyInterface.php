<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\TransactionStatus;

use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface;

interface ValidationStrategyInterface
{
    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse|bool
     */
    public function validate(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer);
}
