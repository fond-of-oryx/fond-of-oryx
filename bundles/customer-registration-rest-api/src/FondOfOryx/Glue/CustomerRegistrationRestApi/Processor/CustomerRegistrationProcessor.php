<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

use FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\CustomerRegistrationRestApiConfig;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface as PasswordGeneratorInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use ArrayObject;

class CustomerRegistrationProcessor implements CustomerRegistrationProcessorInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface
     */
    protected $customerClient;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface
     */
    protected CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapper;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected RestApiErrorInterface $restApiError;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface
     */
    protected PasswordGeneratorInterface $passwordGenerator;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface
     */
    private CustomerRegistrationRestApiClientInterface $client;

    /**
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface $customerClient
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface $passwordGenerator
     * @param \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface $client
     */
    public function __construct(
        CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        CustomerRegistrationRestApiToCustomerClientInterface $customerClient,
        PasswordGeneratorInterface $passwordGenerator,
        CustomerRegistrationRestApiClientInterface $client
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->customerClient = $customerClient;
        $this->customerRegistrationResourceMapper = $customerRegistrationResourceMapper;
        $this->restApiError = $restApiError;
        $this->passwordGenerator = $passwordGenerator;
        $this->client = $client;
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
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restCustomerRegistrationRequestAttributesTransfer->getEmail()) {
            return $this->restApiError->addEmailRequiredError($restResponse);
        }

        if (!$restCustomerRegistrationRequestAttributesTransfer->getAcceptGdpr()) {
            return $this->restApiError->addNotAcceptedGdprError($restResponse);
        }

        $customerTransfer = (new CustomerTransfer())->fromArray($restCustomerRegistrationRequestAttributesTransfer->toArray(), true);
        $customerTransfer->setPassword($this->passwordGenerator->generate());
        $customerResponseTransfer = $this->customerClient->registerCustomer($customerTransfer);

        if ($customerResponseTransfer->getErrors() !== null) {
            $this->preProcessCustomerErrorOnRegistration($customerTransfer, $customerResponseTransfer->getErrors());
        }

        if (!$customerResponseTransfer->getIsSuccess()) {
            return $this->restApiError->processCustomerErrorOnRegistration(
                $restResponse,
                $customerResponseTransfer,
            );
        }

        $customerTransfer = $customerResponseTransfer->getCustomerTransfer();

        $restCustomersResponseAttributesTransfer = $this->customerRegistrationResourceMapper
            ->mapCustomerTransferToRestCustomerRegistrationResponseTransfer(
                $customerTransfer,
                new RestCustomerRegistrationResponseTransfer(),
            );

        $restResource = $this->restResourceBuilder->createRestResource(
            CustomerRegistrationRestApiConfig::RESOURCE_CUSTOMER_REGISTRATION,
            $customerResponseTransfer->getCustomerTransfer()->getCustomerReference(),
            $restCustomersResponseAttributesTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param ArrayObject<\Generated\Shared\Transfer\CustomerErrorTransfer> $customerResponseErrors
     *
     * @return void
     */
    protected function preProcessCustomerErrorOnRegistration(CustomerTransfer $customerTransfer, ArrayObject $customerResponseErrors): void
    {
        foreach ($customerResponseErrors as $error) {
            if ($error->getMessage() === RestApiErrorInterface::ERROR_MESSAGE_CUSTOMER_EMAIL_ALREADY_USED) {
                $this->client->handleKnownCustomer($customerTransfer);
            }
        }
    }
}
