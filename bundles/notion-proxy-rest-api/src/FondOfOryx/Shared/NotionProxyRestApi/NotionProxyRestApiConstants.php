<?php

namespace FondOfOryx\Shared\NotionProxyRestApi;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface NotionProxyRestApiConstants
{
    /**
     * Specification:
     * - GuzzleHttp connection authentication header parameters (Required).
     *
     * @api
     *
     * @var string
     */
    public const AUTH_HEADER = 'NOTION_PROXY_REST_API:AUTH_HEADER';

    /**
     * Specification:
     * - GuzzleHttp connection notion version header parameters (Required).
     *
     * @api
     *
     * @var string
     */
    public const NOTION_VERSION_HEADER = 'NOTION_PROXY_REST_API:NOTION_VERSION_HEADER';

    /**
     * Specification:
     * - GuzzleHttp connection base uri. (Optional).
     *
     * @api
     *
     * @var string
     */
    public const BASE_URI = 'NOTION_PROXY_REST_API:BASE_URI';
}
