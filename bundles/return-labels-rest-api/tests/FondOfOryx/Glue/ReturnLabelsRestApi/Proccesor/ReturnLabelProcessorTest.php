<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use Codeception\Test\Unit;
use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClient;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;

class ReturnLabelProcessorTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiClient;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceBuilder;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelProcessor;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequest;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponse;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelsRestApiClient = $this
            ->getMockBuilder(ReturnLabelsRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceBuilder = $this
            ->getMockBuilder(RestResourceBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequest = $this
            ->getMockBuilder(RestRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponse = $this
            ->getMockBuilder(RestResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUser = $this
            ->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestAttributesTransfer = $this
            ->getMockBuilder(RestReturnLabelRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelProcessor = new ReturnLabelProcessor(
            $this->returnLabelsRestApiClient,
            $this->resourceBuilder
        );
    }

    /**
     * @return void
     */
    public function testGetReturnLabel(): void
    {
        $this->resourceBuilder->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponse);

        $this->restRequest->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUser);

        $restResponse = $this->returnLabelProcessor->getReturnLabel(
            $this->restRequest,
            $this->restReturnLabelRequestAttributesTransfer
        );
    }
}
