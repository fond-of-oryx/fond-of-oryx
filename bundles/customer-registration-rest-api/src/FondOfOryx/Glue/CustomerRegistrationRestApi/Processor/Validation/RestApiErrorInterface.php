<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestApiErrorInterface
{
    /**
     * @var string
     */
    public const ERROR_MESSAGE_CUSTOMER_EMAIL_ALREADY_USED = 'customer.email.already.used';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_CUSTOMER_EMAIL_INVALID = 'customer.email.format.invalid';

    /**
     * @var string
     */
    public const ERROR_MESSAGE_CUSTOMER_EMAIL_LENGTH_EXCEEDED = 'customer.email.length.exceeded';

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerAlreadyExistsError(RestResponseInterface $restResponse): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addEmailRequiredError(RestResponseInterface $restResponse): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addNotAcceptedGdprError(RestResponseInterface $restResponse): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param string $errorMessage
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerCantRegisterMessageError(RestResponseInterface $restResponse, string $errorMessage): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param \Generated\Shared\Transfer\CustomerResponseTransfer $customerResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processCustomerErrorOnRegistration(
        RestResponseInterface $restResponse,
        CustomerResponseTransfer $customerResponseTransfer
    ): RestResponseInterface;
}
