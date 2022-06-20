<?php

namespace FondOfOryx\Zed\PayoneSecureInvoice\Business\TransactionStatus;

use FondOfOryx\Shared\PayoneSecureInvoice\PayoneSecureInvoiceConstants;
use FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig;
use Generated\Shared\Transfer\PayoneStandardParameterTransfer;
use SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface;
use SprykerEco\Shared\Payone\PayoneApiConstants;
use SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse;
use SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface;

class ValidationStrategy implements ValidationStrategyInterface
{
    /**
     * @var \SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface
     */
    protected $hashGenerator;

    /**
     * @var \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\Payone\Business\Key\HashGeneratorInterface $hashGenerator
     * @param \FondOfOryx\Zed\PayoneSecureInvoice\PayoneSecureInvoiceConfig $config
     */
    public function __construct(
        HashGeneratorInterface $hashGenerator,
        PayoneSecureInvoiceConfig $config
    ) {
        $this->hashGenerator = $hashGenerator;
        $this->config = $config;
    }

    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse|bool
     */
    public function validate(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer)
    {
        $credentials = $this->getCredentials($request, $standardParameterTransfer);

        $systemHashedKey = $this->hashGenerator->hash($credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY]);
        if ($request->getKey() !== $systemHashedKey) {
            return $this->createErrorResponse('Payone transaction status update: Given and internal key do not match!');
        }

        if ((int)$request->getAid() !== (int)$credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID]) {
            return $this->createErrorResponse('Payone transaction status update: Invalid Aid! System: ' . $credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID] . ' Request: ' . $request->getAid());
        }

        if ((int)$request->getPortalid() !== (int)$credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID]) {
            return $this->createErrorResponse('Payone transaction status update: Invalid Portalid! System: ' . $credentials[PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID] . ' Request: ' . $request->getPortalid());
        }

        return true;
    }

    /**
     * @param \SprykerEco\Shared\Payone\Dependency\TransactionStatusUpdateInterface $request
     * @param \Generated\Shared\Transfer\PayoneStandardParameterTransfer $standardParameterTransfer
     *
     * @return array
     */
    protected function getCredentials(TransactionStatusUpdateInterface $request, PayoneStandardParameterTransfer $standardParameterTransfer): array
    {
        if ($request->getClearingtype() === PayoneApiConstants::CLEARING_TYPE_INVOICE) {
            return $this->config->getCredentials();
        }

        return [
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_AID => $standardParameterTransfer->getAid(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_PORTAL_ID => $standardParameterTransfer->getPortalId(),
            PayoneSecureInvoiceConstants::PAYONE_CREDENTIALS_KEY => $standardParameterTransfer->getKey(),
        ];
    }

    /**
     * @param string $errorMessage
     *
     * @return \SprykerEco\Zed\Payone\Business\Api\TransactionStatus\TransactionStatusResponse
     */
    protected function createErrorResponse(string $errorMessage): TransactionStatusResponse
    {
        $response = new TransactionStatusResponse(false);
        $response->setErrorMessage($errorMessage);

        return $response;
    }
}
