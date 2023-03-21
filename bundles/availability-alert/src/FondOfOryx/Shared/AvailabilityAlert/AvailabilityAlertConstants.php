<?php

namespace FondOfOryx\Shared\AvailabilityAlert;

interface AvailabilityAlertConstants
{
    /**
     * @var string
     */
    public const MINIMAL_PERCENTAGE_DIFFERENCE = 'MINIMAL_PERCENTAGE_DIFFERENCE';

    /**
     * @var int
     */
    public const MINIMAL_PERCENTAGE_DIFFERENCE_VALUE = 50;

    /**
     * @var string
     */
    public const PRODUCT_ATTRIBUTE_FOR_DATE_CHECK = 'AvailabilityAlert::PRODUCT_ATTRIBUTE_FOR_DATE_CHECK';

    /**
     * @var string
     */
    public const PRODUCT_DEFAULT_ATTRIBUTE_FOR_DATE_CHECK = 'release_date';
}
