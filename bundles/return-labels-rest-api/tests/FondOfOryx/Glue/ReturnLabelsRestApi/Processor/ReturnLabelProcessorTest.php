<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor;

use Codeception\Test\Unit;
use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClient;
use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessor;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ReturnLabelProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resouceBuilderMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestAttributesTransfer;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestErrorMessageTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErrorMessageTransferMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface||\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface
     */
    protected $processor;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(ReturnLabelsRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resouceBuilderMock = $this->getMockBuilder(RestResourceBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestAttributesTransfer = $this->getMockBuilder(RestReturnLabelRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelResponseTransferMock = $this->getMockBuilder(RestReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErrorMessageTransferMock = $this->getMockBuilder(RestErrorMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new ReturnLabelProcessor($this->clientMock, $this->resouceBuilderMock);
    }

    /**
     * @return void
     */
    public function testGetReturnLabelFailed(): void
    {
        $this->resouceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('generateReturnLabel')
            ->willReturn($this->restReturnLabelResponseTransferMock);

        $this->restReturnLabelResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(42);

        $this->restReturnLabelRequestAttributesTransfer->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressUuid')
            ->willReturn('company-unit-address-uuid');

        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setStatus(400)
            ->setCode(1000)
            ->setDetail('No company-unit-address (company-unit-address-uuid) found for customer 42');

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with($restErrorMessageTransfer)
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('getErrors')
            ->willReturn([$restErrorMessageTransfer]);

        $response = $this->processor->getReturnLabel(
            $this->restRequestMock,
            $this->restReturnLabelRequestAttributesTransfer
        );

        static::assertGreaterThan(
            0,
            count($response->getErrors())
        );
    }

    /**
     * @return void
     */
    public function testGetReturnLabelSuccess(): void
    {
        $this->resouceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('generateReturnLabel')
            ->willReturn($this->restReturnLabelResponseTransferMock);

        $this->restReturnLabelResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->resouceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(42);

        $this->restReturnLabelRequestAttributesTransfer->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressUuid')
            ->willReturn('company-unit-address-uuid');

        $response = $this->processor->getReturnLabel(
            $this->restRequestMock,
            $this->restReturnLabelRequestAttributesTransfer
        );

        static::assertEquals(
            0,
            count($response->getErrors())
        );
    }
}
