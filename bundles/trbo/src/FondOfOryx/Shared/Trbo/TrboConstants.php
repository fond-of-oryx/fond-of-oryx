<?php

namespace FondOfOryx\Shared\Trbo;

interface TrboConstants
{
    /**
     * @var string
     */
    public const TRBO_API_SHOP_ID = 'TRBO_API_SHOP_ID';

    /**
     * @var string
     */
    public const TRBO_API_CLIENT_ID = 'TRBO_API_CLIENT_ID';

    /**
     * @var string
     */
    public const TRBO_API_KEY = 'TRBO_API_KEY';

    /**
     * @var string
     */
    public const TRBO_API_URL = 'TRBO_API_URL';

    /**
     * @var string
     */
    public const TRBO_API_TIMEOUT = 'TRBO_API_TIMEOUT';

    /**
     * @var string
     */
    public const TRBO_API_HEADER_PARAM_SHOPID = 'X-REQUEST-SHOPID';

    /**
     * @var string
     */
    public const TRBO_API_HEADER_PARAM_CLIENTID = 'X-REQUEST-CLIENTID';

    /**
     * @var string
     */
    public const TRBO_API_HEADER_PARAM_APIKEY = 'X-REQUEST-APIKEY';

    /**
     * @var string
     */
    public const TRBO_COOKIE_USERID = 'trbo_usr';

    /**
     * @var string
     */
    public const TRBO_API_FALLBACK_TIMEOUT = '0.3';
}
