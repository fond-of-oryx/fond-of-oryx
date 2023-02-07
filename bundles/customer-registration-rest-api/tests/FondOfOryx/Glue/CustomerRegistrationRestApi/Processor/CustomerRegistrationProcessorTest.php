<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerRegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessor
     */
    protected $customerRegistrationProcessor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerRegistrationRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationAttributesTransfer;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerRegistrationResponseTransferMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected \PHPUnit\Framework\MockObject\MockObject|CustomerRegistrationRestApiToCustomerClientInterface $customerClientMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestApiErrorInterface|\PHPUnit\Framework\MockObject\MockObject $restApiErrorMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected \PHPUnit\Framework\MockObject\MockObject|CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapperMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected \PHPUnit\Framework\MockObject\MockObject|GeneratorInterface $passwordGeneratorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerClientMock = $this->getMockBuilder(CustomerRegistrationRestApiToCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->passwordGeneratorMock = $this->getMockBuilder(GeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerRegistrationResponseTransferMock = $this->getMockBuilder(RestCustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResourceMapperMock = $this->getMockBuilder(CustomerRegistrationResourceMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationProcessor = new CustomerRegistrationProcessor(
            $this->customerRegistrationResourceMapperMock,
            $this->restResourceBuilderMock,
            $this->restApiErrorMock,
            $this->customerClientMock,
            $this->passwordGeneratorMock,
        );
    }

    /**
     * @return void
     */
    public function testRegister(): void
    {
        $this->passwordGeneratorMock->expects(static::once())
            ->method('generate');

        $this->customerClientMock->expects(static::once())
            ->method('registerCustomer');

        $restCustomerRegistrationRequestAttributes = (new RestCustomerRegistrationRequestAttributesTransfer())
            ->setEmail('foo@foo.de')
            ->setAcceptGdpr(true);

        $this->customerRegistrationProcessor->register(
            $this->restRequestMock,
            $restCustomerRegistrationRequestAttributes,
        );
    }
}
