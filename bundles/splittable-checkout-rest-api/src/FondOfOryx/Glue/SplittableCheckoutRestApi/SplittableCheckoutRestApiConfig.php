<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class SplittableCheckoutRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_SPLITTABLE_CHECKOUT = 'splittable-checkout';
    public const CONTROLLER_SPLITTABLE_CHECKOUT = 'splittable-checkout-resource';

    public const RESOURCE_SPLITTABLE_TOTALS = 'splittable-totals';
    public const CONTROLLER_SPLITTABLE_TOTALS = 'splittable-totals-resource';

    public const RESPONSE_CODE_SPLITTABLE_CHECKOUT_NOT_PLACED = '8000';
    public const EXCEPTION_MESSAGE_SPLITTABLE_CHECKOUT_NOT_PLACED = 'Can\'t get splittable Quote by given data.';

    public const RESPONSE_CODE_SPLITTABLE_TOTALS_NOT_FOUND = '9000';
    public const EXCEPTION_MESSAGE_SPLITTABLE_TOTALS_NOT_FOUND = 'Can\'t get splittable total by given data.';

    /**
     * @example
     * [
     *  'PaymentProvider1' => [
     *   'credit card' => 'paymentProvider1CreditCard',
     *   'invoice' => 'paymentProvider1Invoice',
     *  ],
     * ]
     *
     * @return string[][]
     */
    public function getPaymentProviderMethodToStateMachineMapping(): array
    {
        return [];
    }
}
