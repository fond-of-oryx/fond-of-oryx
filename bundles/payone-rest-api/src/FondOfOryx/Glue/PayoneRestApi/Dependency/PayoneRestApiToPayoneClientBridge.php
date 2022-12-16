<?php

namespace FondOfOryx\Glue\PayoneRestApi\Dependency;

use Generated\Shared\Transfer\PayoneTransactionStatusUpdateTransfer;
use SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer;
use SprykerEco\Client\Payone\PayoneClientInterface;

class PayoneRestApiToPayoneClientBridge implements PayoneRestApiToPayoneClientInterface
{
    /**
     * @var \SprykerEco\Client\Payone\PayoneClientInterface
     */
    protected $client;

    /**
     * @param \SprykerEco\Client\Payone\PayoneClientInterface $payoneClient
     */
    public function __construct(PayoneClientInterface $payoneClient)
    {
        $this->client = $payoneClient;
    }

    /**
     * Specification:
     * - Processes and saves transaction status update received from Payone.
     *
     * @param \Generated\Shared\Transfer\PayoneTransactionStatusUpdateTransfer $statusUpdateTransfer
     *
     * @return \Generated\Shared\Transfer\PayoneTransactionStatusUpdateTransfer
     * @api
     *
     */
    public function updateStatus(PayoneTransactionStatusUpdateTransfer $statusUpdateTransfer): PayoneTransactionStatusUpdateTransfer
    {
        return $this->client->updateStatus($statusUpdateTransfer);
    }

    /**
     * Specification:
     * - Prepares credit card check request to bring standard parameters and hash to front-end.
     *
     * @return \SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer
     * @api
     *
     */
    public function getCreditCardCheckRequest(): CreditCardCheckContainer
    {
        return $this->client->getCreditCardCheckRequest();
    }
}
