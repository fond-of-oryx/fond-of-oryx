<?php

namespace FondOfOryx\Shared\CustomerSessionController;

interface CustomerSessionControllerConstants
{
    /**
     * @var string
     */
    public const ROUTE_CUSTOMER_OVERVIEW = 'customer/overview';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_CUSTOMER_ALREADY_LOGGED_IN = 'customer_page.error.customer_already_logged_in';

    /**
     * @var string
     */
    public const GLOSSARY_KEY_INVALID_ACCESS_TOKEN = 'customer_page.error.invalid_access_token';
}
