<?php

namespace FondOfOryx\Glue\CheckoutRestApiPayoneConnector;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CheckoutRestApiPayoneConnectorConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESPONSE_CODE_PSEUDOCARDPAN_MISSING = '2000';

    /**
     * @var string
     */
    public const RESPONSE_DETAILS_PSEUDOCARDPAN_MISSING = 'Pseudo card pan missing.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_WALLETTYPE_INCORRECT = '2001';

    /**
     * @var string
     */
    public const RESPONSE_DETAILS_WALLETTYPE_INCORRECT = 'Wallet type incorrect.';
}
