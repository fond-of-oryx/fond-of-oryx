<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Dependency\Service;

use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Service\Payone\PayoneServiceInterface;

class GiftCardProportionalValuePayoneConnectorToPayoneService implements GiftCardProportionalValuePayoneConnectorToPayoneServiceInterface
{
    /**
     * @var \SprykerEco\Service\Payone\PayoneServiceInterface
     */
    protected $service;

    /**
     * @param \SprykerEco\Service\Payone\PayoneServiceInterface $payoneService
     */
    public function __construct(PayoneServiceInterface $payoneService)
    {
        $this->service = $payoneService;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function distributeOrderPrice(OrderTransfer $orderTransfer): OrderTransfer
    {
        return $this->service->distributeOrderPrice($orderTransfer);
    }
}
