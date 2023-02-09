<?php

namespace FondOfOryx\Shared\CustomerRegistrationRestApi;

interface CustomerRegistrationRestApiConstants
{
    /**
     * @var string
     */
    public const REGISTRATION_CONFIRMATION_TOKEN_URL = 'REGISTRATION_CONFIRMATION_TOKEN_URL';

    /**
     * @var string
     */
    public const BASE_URL_YVES = 'BASE_URL_YVES';

    /**
     * @var string
     */
    public const RESEND_CONFIRMATION_TOKEN = 'customer.registration.resend.confirmation.token';

    /**
     * @var string
     */
    public const SEND_LOGIN_TOKEN = 'customer.registration.send.onetimepassword.token';
}
