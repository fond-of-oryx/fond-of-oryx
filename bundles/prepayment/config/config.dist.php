<?php
/**
 * Copy over the following configs to your config
 */

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Oms\OmsConstants;
use Spryker\Shared\Sales\SalesConstants;
use Spryker\Zed\Oms\OmsConfig;

$config[KernelConstants::DEPENDENCY_INJECTOR_YVES] = [
    'Checkout' => [
        'Prepayment',
    ],
];
$config[KernelConstants::DEPENDENCY_INJECTOR_ZED] = [
    'Payment' => [
        'Prepayment',
    ],
    'Oms' => [
        'Prepayment',
    ],
];

$config[OmsConstants::PROCESS_LOCATION] = [
    OmsConfig::DEFAULT_PROCESS_LOCATION,
    APPLICATION_VENDOR_DIR . 'fond-of-oryx/prepayment/config/Zed/Oms',
];

$config[OmsConstants::ACTIVE_PROCESSES] = [
    'Prepayment01',
];

$config[SalesConstants::PAYMENT_METHOD_STATEMACHINE_MAPPING] = [
    PrepaymentConstants::PAYMENT_METHOD_PREPAYMENT => 'Prepayment01',
];
