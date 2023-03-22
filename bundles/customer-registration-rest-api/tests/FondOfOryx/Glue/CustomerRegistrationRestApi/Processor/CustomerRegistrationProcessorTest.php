<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\CustomerErrorTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerRegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessor
     */
    protected CustomerRegistrationProcessor $customerRegistrationProcessor;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Dependency\Client\CustomerRegistrationRestApiToCustomerClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerRegistrationRestApiToCustomerClientInterface $customerClientMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Validation\RestApiErrorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestApiErrorInterface $restApiErrorMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Mapper\CustomerRegistrationResourceMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerRegistrationResourceMapperInterface $customerRegistrationResourceMapperMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\Password\GeneratorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|GeneratorInterface $passwordGeneratorMock;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerRegistrationRestApiClientInterface $clientMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerResponseTransfer
     */
    protected MockObject|CustomerResponseTransfer $customerResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerErrorTransfer
     */
    protected $customerErrorTransferMock;

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

        $this->customerRegistrationResourceMapperMock = $this->getMockBuilder(CustomerRegistrationResourceMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CustomerRegistrationRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerErrorTransferMock = $this->getMockBuilder(CustomerErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationProcessor = new CustomerRegistrationProcessor(
            $this->customerRegistrationResourceMapperMock,
            $this->restResourceBuilderMock,
            $this->restApiErrorMock,
            $this->customerClientMock,
            $this->passwordGeneratorMock,
            $this->clientMock,
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
            ->method('registerCustomer')
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErrors')
            ->willReturn(new ArrayObject());

        $restCustomerRegistrationRequestAttributes = (new RestCustomerRegistrationRequestAttributesTransfer())
            ->setEmail('foo@foo.de')
            ->setAcceptGdpr(true);

        $this->customerRegistrationProcessor->register(
            $this->restRequestMock,
            $restCustomerRegistrationRequestAttributes,
        );
    }
}
