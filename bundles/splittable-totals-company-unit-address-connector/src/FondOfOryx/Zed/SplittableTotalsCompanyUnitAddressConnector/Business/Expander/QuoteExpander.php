<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Expander;

use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class QuoteExpander implements QuoteExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @param \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $quoteTransfer = $this->expandWithBillingAddress($splittableTotalsRequestTransfer, $quoteTransfer);
        $quoteTransfer = $this->expandWithShippingAddress($splittableTotalsRequestTransfer, $quoteTransfer);

        return $this->expandWithBillingSameAsShipping($quoteTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithBillingAddress(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getBillingAddressBySplittableTotalsRequestTransfer(
            $splittableTotalsRequestTransfer
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        return $quoteTransfer->setBillingAddress($addressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function expandWithShippingAddress(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $addressTransfer = $this->companyUnitAddressReader->getShippingAddressBySplittableTotalsRequestTransfer(
            $splittableTotalsRequestTransfer
        );

        if ($addressTransfer === null) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getShipment() !== null) {
            $quoteTransfer->getShipment()->setShippingAddress($addressTransfer);
        }

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
                continue;
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
