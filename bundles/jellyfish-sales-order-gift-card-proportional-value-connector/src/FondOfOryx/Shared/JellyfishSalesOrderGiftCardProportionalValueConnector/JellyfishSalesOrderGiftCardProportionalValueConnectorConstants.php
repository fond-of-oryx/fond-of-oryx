<?php

namespace FondOfOryx\Shared\JellyfishSalesOrderGiftCardProportionalValueConnector;

interface JellyfishSalesOrderGiftCardProportionalValueConnectorConstants
{
    /**
     * @var string
     */
    public const EXPENSE_MAPPING = 'JellyfishSalesOrderGiftCardProportionalValueConnector:EXPENSE_MAPPING';

    /**
     * @var array<string>
     */
    public const DEFAULT_EXPENSE_MAPPING = ['SHIPMENT_EXPENSE_TYPE' => 'freight'];
}
