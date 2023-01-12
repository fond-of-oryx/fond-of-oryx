<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface;
use FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface;
use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerRegistrationResponseTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationRequestAttributesTransfer;
use Generated\Shared\Transfer\RestCustomerRegistrationResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerRegistrationProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Processor\CustomerRegistrationProcessor
     */
    protected $customerRegistrationProcessor;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\RequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMapperMock;

    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Mapper\ResponseMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \FondOfOryx\Client\CustomerRegistrationRestApi\CustomerRegistrationRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerRegistrationRestApiClientMock;

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
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRestApiClientMock = $this->getMockBuilder(CustomerRegistrationRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMapperMock = $this->getMockBuilder(RequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMapperMock = $this->getMockBuilder(ResponseMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerRegistrationRequestAttributesTransferMock = $this->getMockBuilder(RestCustomerRegistrationRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationRequestTransferMock = $this->getMockBuilder(CustomerRegistrationRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationAttributesTransfer = $this->getMockBuilder(CustomerRegistrationAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerRegistrationResponseTransferMock = $this->getMockBuilder(RestCustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationResponseTransferMock = $this->getMockBuilder(CustomerRegistrationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerRegistrationProcessor = new CustomerRegistrationProcessor(
            $this->requestMapperMock,
            $this->responseMapperMock,
            $this->restResourceBuilderMock,
            $this->customerRegistrationRestApiClientMock,
        );
    }

    /**
     * @return void
     */
    public function testRegister(): void
    {
        $this->requestMapperMock->expects($this->atLeastOnce())
            ->method('mapRequestAttributesToTransfer')
            ->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('setType')
            ->with(CustomerRegistrationConstants::TYPE_REGISTRATION)
            ->willReturnSelf();

        $this->customerRegistrationAttributesTransfer->expects($this->atLeastOnce())
            ->method('getEmail')
            ->willReturn('mail@foo.bar');

        $this->customerRegistrationRestApiClientMock->expects($this->atLeastOnce())
            ->method('handleCustomerRegistrationRequest')
            ->with($this->customerRegistrationRequestTransferMock)
            ->willReturn($this->customerRegistrationResponseTransferMock);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_CREATED)
            ->willReturnSelf();

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationProcessor->register(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdateRegistration(): void
    {
        $this->requestMapperMock->expects($this->atLeastOnce())
            ->method('mapRequestAttributesToTransfer')
            ->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('setAttributes')
            ->willReturnSelf();

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('setType')
            ->with(CustomerRegistrationConstants::TYPE_GDPR)
            ->willReturnSelf();

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationAttributesTransfer->expects($this->atLeastOnce())
            ->method('setToken')
            ->with('token')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationRestApiClientMock->expects($this->atLeastOnce())
            ->method('handleCustomerRegistrationRequest')
            ->with($this->customerRegistrationRequestTransferMock)
            ->willReturn($this->customerRegistrationResponseTransferMock);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_OK)
            ->willReturnSelf();

        $this->restRequestMock->expects($this->atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->requestMock->expects($this->atLeastOnce())
            ->method('get')
            ->with('id')
            ->willReturn('token');

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationProcessor->updateRegistration(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testVerifyEmail(): void
    {
        $this->requestMapperMock->expects($this->atLeastOnce())
            ->method('mapRequestAttributesToTransfer')
            ->willReturn($this->customerRegistrationRequestTransferMock);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('setAttributes')
            ->willReturnSelf();

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('setType')
            ->with(CustomerRegistrationConstants::TYPE_EMAIL_VERIFICATION)
            ->willReturnSelf();

        $this->customerRegistrationRequestTransferMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationAttributesTransfer->expects($this->atLeastOnce())
            ->method('setToken')
            ->with('token')
            ->willReturn($this->customerRegistrationAttributesTransfer);

        $this->customerRegistrationRestApiClientMock->expects($this->atLeastOnce())
            ->method('handleCustomerRegistrationRequest')
            ->with($this->customerRegistrationRequestTransferMock)
            ->willReturn($this->customerRegistrationResponseTransferMock);

        $this->restResourceBuilderMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects($this->atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_ACCEPTED)
            ->willReturnSelf();

        $this->restRequestMock->expects($this->atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->requestMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                ['id'],
                ['verify'],
            )
            ->willReturnOnConsecutiveCalls(
                'token',
                'true',
            );

        $this->assertSame(
            $this->restResponseMock,
            $this->customerRegistrationProcessor->verifyEmail(
                $this->restRequestMock,
                $this->restCustomerRegistrationRequestAttributesTransferMock,
            ),
        );
    }
}
