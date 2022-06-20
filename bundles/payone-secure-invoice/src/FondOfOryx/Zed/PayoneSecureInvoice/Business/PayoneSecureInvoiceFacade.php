<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business;

use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface;
use SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface;

/**
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Business\PayoneSecureInvoiceBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\PayoneSecureInvoice\Persistence\PayoneSecureInvoiceRepositoryInterface getRepository()
 */
class PayoneSecureInvoiceFacade extends AbstractFacade implements PayoneSecureInvoiceFacadeInterface
{
    /**
     * @param \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface $requestContainer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\Request\Container\ContainerInterface
     */
    public function mapCredentials(ContainerInterface $requestContainer): ContainerInterface
    {
        return $this->getFactory()->createCredentialsMapper()->map($requestContainer);
    }

    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse|bool
     */
    public function validateTransactionStatus(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer)
    {
        return $this->getFactory()->createTransactionStatusValidationStrategy()->validate($request, $standardParameterTransfer);
    }
}
