<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

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
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface $customerClient
     * @param \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface $passwordGenerator
     */
    public function __construct(
        CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapper,
        RestResourceBuilderInterface $restResourceBuilder,
        RestApiErrorInterface $restApiError,
        CustomerRegistrationRestApiToCustomerClientInterface $customerClient,
        PasswordGeneratorInterface $passwordGenerator
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->customerClient = $customerClient;
        $this->customerRegistrationResourceMapper = $customerRegistrationResourceMapper;
        $this->restApiError = $restApiError;
        $this->passwordGenerator = $passwordGenerator;
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
}
