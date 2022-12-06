<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

use FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface;
use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerRegistrationProcessor implements CustomerRegistrationProcessorInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface
     */
    protected $customerRegistrationRestApiClient;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface
     */
    protected $requestMapper;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface
     */
    protected $responseMapper;

    /**
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface $requestMapper
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface $responseMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface $customerRegistrationRestApiClient
     */
    public function __construct(
        RequestMapperInterface $requestMapper,
        ResponseMapperInterface $responseMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        CustomerRegistrationRestApiClientInterface $customerRegistrationRestApiClient
    ) {
        $this->requestMapper = $requestMapper;
        $this->responseMapper = $responseMapper;
        $this->restResourceBuilder = $restResourceBuilder;
        $this->customerRegistrationRestApiClient = $customerRegistrationRestApiClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function register(
        RestRequestInterface $restRequest,
        RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): RestResponseInterface {
        $request = $this->requestMapper->mapRequestAttributesToTransfer($restCustomerRegistrationRequestAttributesTransfer);

        if (!$request->getAttributes()->getEmail()) {
            return $this->createEmailRequiredError();
        }

        $this->customerRegistrationRestApiClient->handleCustomerRegistrationRequest(
            $request->setType(CustomerRegistrationConstants::TYPE_REGISTRATION),
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->setStatus(Response::HTTP_CREATED);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function updateRegistration(
        RestRequestInterface $restRequest,
        RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): RestResponseInterface {
        $request = $this->requestMapper->mapRequestAttributesToTransfer($restCustomerRegistrationRequestAttributesTransfer);

        $mappedAttributes = $request->getAttributes();
        $mappedAttributes
            ->setToken($this->getToken($restRequest->getHttpRequest()));

        $this->customerRegistrationRestApiClient->handleCustomerRegistrationRequest(
            $request->setAttributes($mappedAttributes)->setType(CustomerRegistrationConstants::TYPE_GDPR),
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->setStatus(Response::HTTP_OK);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer|null $restCustomerRegistrationRequestAttributesTransfer
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function verifyEmail(
        RestRequestInterface $restRequest,
        ?RestCustomerRegistrationRequestAttributesTransfer $restCustomerRegistrationRequestAttributesTransfer
    ): RestResponseInterface {
        if ($restCustomerRegistrationRequestAttributesTransfer === null){
            $restCustomerRegistrationRequestAttributesTransfer = new RestCustomerRegistrationRequestAttributesTransfer();
        }

        $request = $this->requestMapper->mapRequestAttributesToTransfer($restCustomerRegistrationRequestAttributesTransfer);

        $mappedAttributes = $request->getAttributes();
        $mappedAttributes
            ->setToken($this->getToken($restRequest->getHttpRequest()));

        $verify = $restRequest->getHttpRequest()->get('verify', false);
        if ($mappedAttributes->getVerifyEmail() === null){
            $mappedAttributes->setVerifyEmail($verify === 'true' ? true : $verify);
        }

        $this->customerRegistrationRestApiClient->handleCustomerRegistrationRequest(
            $request->setAttributes($mappedAttributes)->setType(CustomerRegistrationConstants::TYPE_EMAIL_VERIFICATION),
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->setStatus(Response::HTTP_ACCEPTED);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createEmailRequiredError(): RestResponseInterface
    {
        $restErrorMessageTransfer = new RestErrorMessageTransfer();

        $restErrorMessageTransfer->setStatus(Response::HTTP_BAD_REQUEST)
            ->setCode(CustomerRegistrationRestApiConfig::EMAIL_REQUIRED_ERROR_CODE)
            ->setDetail(CustomerRegistrationRestApiConfig::EMAIL_REQUIRED_ERROR_DETAIL);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getToken(Request $request): string
    {
        return $request->get('id');
    }
}
