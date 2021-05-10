<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Expander;

use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $quoteTransfer = $this->expandWithBillingAddress($restSplittableTotalsRequestTransfer, $quoteTransfer);
        $quoteTransfer = $this->expandWithShippingAddress($restSplittableTotalsRequestTransfer, $quoteTransfer);

        return $this->expandWithBillingSameAsShipping($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithBillingAddress(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getBillingAddressByRestSplittableTotalsRequestTransfer(
            $restSplittableTotalsRequestTransfer
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setBillingAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithShippingAddress(
        RestSplittableTotalsRequestTransfer $restSplittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getShippingAddressByRestSplittableTotalsRequestTransfer(
            $restSplittableTotalsRequestTransfer
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getShipment() === null) {
            $quoteTransfer->setShipment(new ShipmentTransfer());
        }

        $quoteTransfer->getShipment()->setShippingAddress($addressTransfer);
        $quoteTransfer->setShippingAddress($addressTransfer);

        return $this->expandItemsWithShippingAddress($quoteTransfer, $addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\AddressTransfer $shippingAddressTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandItemsWithShippingAddress(
        QuoteTransfer $quoteTransfer,
        AddressTransfer $shippingAddressTransfer
    ): QuoteTransfer {
        foreach ($quoteTransfer->getItems() as $item) {
            if ($item->getShipment() === null) {
                $item->setShipment(new ShipmentTransfer());
            }

            $item->getShipment()->setShippingAddress($shippingAddressTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithBillingSameAsShipping(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $billingAddressTransfer = $quoteTransfer->getBillingAddress();
        $shippingAddressTransfer = $quoteTransfer->getShippingAddress();

        if ($billingAddressTransfer === null || $shippingAddressTransfer === null) {
            return $quoteTransfer->setBillingSameAsShipping(false);
        }

        return $quoteTransfer->setBillingSameAsShipping(
            $billingAddressTransfer->toArray() == $shippingAddressTransfer->toArray()
        );
    }
}
