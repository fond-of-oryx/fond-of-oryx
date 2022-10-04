<?php

namespace FondOfOryx\Shared\CustomerTokenManager;

interface CustomerTokenManagerConstants
{
    /**
     * @var string
     */
    public const REDIRECT_PATH_AFTER_LOGIN_DEFAULT = '/';

    /**
     * @var string
     */
    public const REDIRECT_PATH_AFTER_LOGIN = 'REDIRECT_PATH_AFTER_LOGIN';

    /**
     * @var string
     */
    public const SIGNATURE_PARAMETER = 'SIGNATURE_PARAMETER';

    /**
     * @var string
     */
    public const CUSTOMER_ANONYMOUS_PATTERN_DEFAULT = '^/.*';

    /**
     * @var string
     */
    public const CUSTOMER_ANONYMOUS_PATTERN = 'CUSTOMER_ANONYMOUS_PATTERN';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_CUSTOMER_LOGGED_IN = 'customer_token_manager.success.customer_logged_in';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_INVALID_ACCESS_TOKEN = 'customer_token_manager.error.invalid_access_token';
}
