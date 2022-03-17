<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OmsOrderMailExpander implements OmsOrderMailExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpanderInterface
     */
    protected $addressExpander;

    /**
     * @param \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpanderInterface $addressExpander
     */
    public function __construct(AddressExpanderInterface $addressExpander)
    {
        $this->addressExpander = $addressExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $orderTransfer = $this->expandBillingAddress($orderTransfer);
        $orderTransfer = $this->expandShippingAddress($orderTransfer);
        $this->expandShippingAddressOnItemLevel($orderTransfer);

        return $mailTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function expandBillingAddress(OrderTransfer $orderTransfer): OrderTransfer
    {
        $addressTransfer = $orderTransfer->getBillingAddress();

        if ($addressTransfer === null) {
            return $orderTransfer;
        }

        $addressTransfer = $this->addressExpander->expand($addressTransfer);

        return $orderTransfer->setBillingAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function expandShippingAddress(OrderTransfer $orderTransfer): OrderTransfer
    {
        $addressTransfer = $orderTransfer->getShippingAddress();

        if ($addressTransfer === null) {
            return $orderTransfer;
        }

        $addressTransfer = $this->addressExpander->expand($addressTransfer);

        return $orderTransfer->setShippingAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    protected function expandShippingAddressOnItemLevel(OrderTransfer $orderTransfer): OrderTransfer
    {
        foreach ($orderTransfer->getItems() as $item) {
            $shipmentTransfer = $item->getShipment();

            if ($shipmentTransfer === null) {
                continue;
            }

            $addressTransfer = $shipmentTransfer->getShippingAddress();

            if ($addressTransfer === null) {
                continue;
            }

            $addressTransfer = $this->addressExpander->expand($addressTransfer);
            $shipmentTransfer->setShippingAddress($addressTransfer);
        }

        return $orderTransfer;
    }
}
