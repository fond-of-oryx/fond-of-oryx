<?php

namespace FondOfOryx\Shared\ReturnLabelsRestApi;

interface ReturnLabelsRestApiConstants
{
    public const ALLOWED_COUNTRY_IDS = 'FOND_OF_ORYX:RETURN_LABELS_REST_API:ALLOWED_COUNTRY_IDS';

    public const ERROR_MESSAGE_ADDRESS_NOT_FOUND = 'Address (%s) not found for customer %s';
    public const ERROR_MESSAGE_ADDRESS_NOT_FOUND_CODE = '300';

    public const ERROR_MESSAGE_COUNTRY_NOT_ALLOWED = 'country not allowed to create return label (company-unit-address-uuid: %s, country-id: %s)';
    public const ERROR_MESSAGE_COUNTRY_NOT_ALLOWED_CODE = '400';
}
