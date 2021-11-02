<?php

namespace FondOfOryx\Shared\ReturnLabelsRestApi;

interface ReturnLabelsRestApiConstants
{
    /**
     * @var string
     */
    public const ALLOWED_COUNTRY_ISO3 = 'FOND_OF_ORYX:RETURN_LABELS_REST_API:ALLOWED_COUNTRY_ISO3';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ADDRESS_NOT_FOUND = 'Address (%s) not found for customer %s';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_ADDRESS_NOT_FOUND_CODE = '300';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_COUNTRY_NOT_ALLOWED = 'country not allowed to create return label (company-unit-address-uuid: %s, country-iso3: %s)';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_COUNTRY_NOT_ALLOWED_CODE = '400';
}
