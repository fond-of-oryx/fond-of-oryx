<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class RestSplittableCheckoutMapper implements RestSplittableCheckoutMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestTotalsMapperInterface
     */
    protected $restTotalsMapper;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestAddressMapperInterface
     */
    protected $restAddressMapper;

    /**
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestTotalsMapperInterface $restTotalsMapper
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestAddressMapperInterface $restAddressMapper
     */
    public function __construct(
        RestTotalsMapperInterface $restTotalsMapper,
        RestAddressMapperInterface $restAddressMapper
    ) {
        $this->restTotalsMapper = $restTotalsMapper;
        $this->restAddressMapper = $restAddressMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutTransfer
     */
    public function fromSplittableCheckout(
        SplittableCheckoutTransfer $splittableCheckoutTransfer
    ): RestSplittableCheckoutTransfer {
        $orderReferences = [];
        $restTotalsList = new ArrayObject();
        $splitKeys = [];
        $billingRestAddressTransfer = null;
        $shippingRestAddressTransfer = null;

        foreach ($splittableCheckoutTransfer->getSplittedQuotes() as $key => $splittedQuoteTransfer) {
            $orderReferences[$key] = $splittedQuoteTransfer->getOrderReference();
            $splitKeys[] = $key;
            $restTotalsTransfer = $this->restTotalsMapper->fromQuote($splittedQuoteTransfer);

            if ($restTotalsTransfer !== null) {
                $restTotalsList->offsetSet($key, $restTotalsTransfer);
            }

            $billingAddressTransfer = $splittedQuoteTransfer->getBillingAddress();

            if ($billingAddressTransfer !== null && $billingRestAddressTransfer === null) {
                $billingRestAddressTransfer = $this->restAddressMapper->fromAddress($billingAddressTransfer);
            }

            $shippingAddressTransfer = $splittedQuoteTransfer->getShippingAddress();

            if ($shippingAddressTransfer !== null && $shippingRestAddressTransfer === null) {
                $shippingRestAddressTransfer = $this->restAddressMapper->fromAddress($shippingAddressTransfer);
            }
        }

        return (new RestSplittableCheckoutTransfer())
            ->setOrderReferences($orderReferences)
            ->setTotalsList($restTotalsList)
            ->setSplitKeys($splitKeys)
            ->setBillingAddress($billingRestAddressTransfer)
            ->setShippingAddress($shippingRestAddressTransfer);
    }
}
