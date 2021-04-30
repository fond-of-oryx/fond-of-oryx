<?php

namespace FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business;

use FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapper;
use FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapperInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class SplittableCheckoutPaymentsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\SplittableCheckoutPaymentsRestApi\Business\Quote\PaymentQuoteMapperInterface
     */
    public function createPaymentQuoteMapper(): PaymentQuoteMapperInterface
    {
        return new PaymentQuoteMapper();
    }
}
