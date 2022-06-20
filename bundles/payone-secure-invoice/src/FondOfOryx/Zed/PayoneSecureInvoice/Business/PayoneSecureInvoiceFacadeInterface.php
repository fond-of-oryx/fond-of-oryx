<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

interface PayoneSecureInvoiceFacadeInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function mapCredentials(ContainerInterface $requestContainer): ContainerInterface;

    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse|bool
     */
    public function validateTransactionStatus(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer);
}
