<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation;

use FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerAlreadyExistsError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::RESPONSE_CODE_CUSTOMER_ALREADY_EXISTS)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(CustomerRegistrationRestApiConfig::RESPONSE_MESSAGE_CUSTOMER_ALREADY_EXISTS);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param string $errorMessage
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerCantRegisterMessageError(RestResponseInterface $restResponse, string $errorMessage): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::RESPONSE_CODE_CUSTOMER_CANT_REGISTER_CUSTOMER)
            ->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setDetail($errorMessage);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerEmailInvalidError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::RESPONSE_CODE_CUSTOMER_EMAIL_INVALID)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(CustomerRegistrationRestApiConfig::RESPONSE_MESSAGE_CUSTOMER_EMAIL_INVALID);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addCustomerEmailLengthExceededError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::RESPONSE_CODE_CUSTOMER_EMAIL_LENGTH_EXCEEDED)
            ->setStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setDetail(CustomerRegistrationRestApiConfig::RESPONSE_MESSAGE_CUSTOMER_EMAIL_LENGTH_EXCEEDED);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addEmailRequiredError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::EMAIL_REQUIRED_ERROR_CODE)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CustomerRegistrationRestApiConfig::EMAIL_REQUIRED_ERROR_DETAIL);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addNotAcceptedGdprError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CustomerRegistrationRestApiConfig::RESPONSE_CODE_NOT_ACCEPTED_GDPR)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CustomerRegistrationRestApiConfig::RESPONSE_DETAILS_NOT_ACCEPTED_GDPR);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param \Generated\Shared\Transfer\CustomerResponseTransfer $customerResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function processKnownCustomerError(RestResponseInterface $restResponse, CustomerResponseTransfer $customerResponseTransfer): RestResponseInterface
    {
        foreach ($customerResponseTransfer->getErrors() as $customerErrorTransfer) {

            if ($customerErrorTransfer->getMessage() === static::ERROR_MESSAGE_CUSTOMER_EMAIL_ALREADY_USED) {
                $restResponse = $this->addCustomerAlreadyExistsError($restResponse);

                continue;
            }

            if ($customerErrorTransfer->getMessage() === static::ERROR_MESSAGE_CUSTOMER_EMAIL_INVALID) {
                $restResponse = $this->addCustomerEmailInvalidError($restResponse);

                continue;
            }

            if ($customerErrorTransfer->getMessage() === static::ERROR_MESSAGE_CUSTOMER_EMAIL_LENGTH_EXCEEDED) {
                $restResponse = $this->addCustomerEmailLengthExceededError($restResponse);

                continue;
            }
        }

        return $restResponse;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     * @param \Generated\Shared\Transfer\CustomerResponseTransfer $customerResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function processCustomerErrorOnRegistration(
        RestResponseInterface $restResponse,
        CustomerResponseTransfer $customerResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->processKnownCustomerError($restResponse, $customerResponseTransfer);

        if (!count($restResponse->getErrors())) {
            return $this->addCustomerCantRegisterMessageError(
                $restResponse,
                CustomerRegistrationRestApiConfig::RESPONSE_MESSAGE_CUSTOMER_CANT_REGISTER_CUSTOMER,
            );
        }

        return $restResponse;
    }
}
