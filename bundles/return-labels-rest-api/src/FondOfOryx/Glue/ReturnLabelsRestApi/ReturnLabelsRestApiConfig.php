<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ReturnLabelsRestApiConfig extends AbstractBundleConfig
{
    public const RESOURCE_RETURN_LABELS = 'return-labels';
    public const CONTROLLER_RETURN_LABELS = 'return-labels-rest-api-resource';

    public const RESPONSE_CODE_NOT_GENERATED = '1000';
    public const RESPONSE_DETAIL_NOT_GENERATED = 'Return label could not be generated.';
}
