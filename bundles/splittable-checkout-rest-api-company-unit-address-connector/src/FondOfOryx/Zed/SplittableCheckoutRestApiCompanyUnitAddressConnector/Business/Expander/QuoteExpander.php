<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Expander;

use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @param \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $quoteTransfer = $this->expandWithBillingAddress($restSplittableCheckoutRequestTransfer, $quoteTransfer);
        $quoteTransfer = $this->expandWithShippingAddress($restSplittableCheckoutRequestTransfer, $quoteTransfer);

        return $this->expandWithBillingSameAsShipping($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithBillingAddress(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getBillingAddressByRestSplittableCheckoutRequestTransfer(
            $restSplittableCheckoutRequestTransfer,
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setBillingAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithShippingAddress(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getShippingAddressByRestSplittableCheckoutRequestTransfer(
            $restSplittableCheckoutRequestTransfer,
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getShipment() === null) {
            $quoteTransfer->setShipment(new ShipmentTransfer());
        }

        $quoteTransfer->getShipment()->setShippingAddress($addressTransfer);

        return $quoteTransfer->setShippingAddress($addressTransfer);
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
            $billingAddressTransfer->toArray() == $shippingAddressTransfer->toArray(),
        );
    }
}
