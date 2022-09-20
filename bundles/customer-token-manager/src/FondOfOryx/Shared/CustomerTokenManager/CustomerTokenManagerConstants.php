<?php

namespace FondOfOryx\Shared\CustomerTokenManager;

interface CustomerTokenManagerConstants
{
    /**
     * @var string
     */
    public const REDIRECT_URL_AFTER_LOGIN_DEFAULT = 'home';

    /**
     * @var string
     */
    public const REDIRECT_URL_AFTER_LOGIN = 'REDIRECT_URL_AFTER_LOGIN';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_CUSTOMER_ALREADY_LOGGED_IN = 'customer_page.error.customer_already_logged_in';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_INVALID_ACCESS_TOKEN = 'customer_page.error.invalid_access_token';
}
