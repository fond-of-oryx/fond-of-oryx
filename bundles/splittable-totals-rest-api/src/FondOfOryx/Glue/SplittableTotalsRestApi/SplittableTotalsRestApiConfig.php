<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class SplittableTotalsRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_SPLITTABLE_TOTALS = 'splittable-totals';
    public const CONTROLLER_SPLITTABLE_TOTALS = 'splittable-totals-resource';

    public const RESPONSE_CODE_SPLITTABLE_TOTALS_NOT_FOUND = '7000';
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
