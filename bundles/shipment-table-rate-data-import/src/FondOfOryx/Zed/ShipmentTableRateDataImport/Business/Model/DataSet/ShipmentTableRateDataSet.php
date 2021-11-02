<?php

namespace FondOfOryx\Zed\ShipmentTableRateDataImport\Business\Model\DataSet;

interface ShipmentTableRateDataSet
{
    /**
     * @var string
     */
    public const SHIPMENT_TABLE_RATE_KEY = 'key';

    /**
     * @var string
     */
    public const SHIPMENT_TABLE_RATE_COUNTRY = 'country';

    /**
     * @var string
     */
    public const SHIPMENT_TABLE_RATE_STORE = 'store';

    /**
     * @var string
     */
    public const SHIPMENT_TABLE_RATE_MAX_PRICE_TO_PAY = 'max_price_to_pay';
}
