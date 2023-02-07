<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class CustomerRegistrationRestApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_CUSTOMER_REGISTRATION = 'customer-registration';

    /**
     * @var string
     */
    public const CONTROLLER_CUSTOMER_REGISTRATION = 'customer-registration-resource';

    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_CODE = '1';

    /**
     * @var string
     */
    public const EMAIL_REQUIRED_ERROR_DETAIL = 'Missing customer e-mail address to start registration process!';

    /**
     * @var string
     */
    public const RESPONSE_CODE_CUSTOMER_CANT_REGISTER_CUSTOMER = '2';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_CUSTOMER_CANT_REGISTER_CUSTOMER = 'Can\'t register a customer.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_CUSTOMER_ALREADY_EXISTS = '3';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_CUSTOMER_ALREADY_EXISTS = 'If this email address is already in use, you will receive a password reset link. Otherwise you must first validate your e-mail address to finish registration. Please check your e-mail.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_NOT_ACCEPTED_GDPR = '4';

    /**
     * @var string
     */
    public const RESPONSE_DETAILS_NOT_ACCEPTED_GDPR = 'Terms and Conditions was not accepted.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_CUSTOMER_EMAIL_INVALID = '5';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_CUSTOMER_EMAIL_INVALID = 'Invalid Email address format.';

    /**
     * @var string
     */
    public const RESPONSE_CODE_CUSTOMER_EMAIL_LENGTH_EXCEEDED = '6';

    /**
     * @var string
     */
    public const RESPONSE_MESSAGE_CUSTOMER_EMAIL_LENGTH_EXCEEDED = 'Email is too long. It should have 100 characters or less.';

}
