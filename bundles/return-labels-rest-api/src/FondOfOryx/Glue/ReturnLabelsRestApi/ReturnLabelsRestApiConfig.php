<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class ReturnLabelsRestApiConfig extends AbstractBundleConfig
{
    public const ACTION_RETURN_LABELS_REST_API_POST = 'post';
    public const RESOURCE_RETURN_LABELS_REST_API = 'return-labels';
    public const CONTROLLER_RETURN_LABELS_REST_API = 'return-labels-rest-api-resource';

    public const RESPONSE_CODE_NO_PERMISSION = '802';
    public const RESPONSE_DETAIL_NO_PERMISSION = 'No permission to read company unit address';
}
