<?php

namespace FondOfOryx\Glue\DocumentsRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

/**
 * @codeCoverageIgnore
 */
class DocumentsRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_DOCUMENTS_API = 'documents';

    /**
     * @var string
     */
    public const CONTROLLER_RESOURCE_DOCUMENTS_API = 'documents-resource';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_UNEXPECTED = 'An unexpected error appeared!';
}
