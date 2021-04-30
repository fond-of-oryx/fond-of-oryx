<?php

namespace FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business;

use FondOfOrxy\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapperInterface;
use FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapper;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutPaymentsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOrxy\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapperInterface
     */
    public function createPaymentQuoteMapper(): PaymentQuoteMapperInterface
    {
        return new PaymentQuoteMapper();
    }
}
