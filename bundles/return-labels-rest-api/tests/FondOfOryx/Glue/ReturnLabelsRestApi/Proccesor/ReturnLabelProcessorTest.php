<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClient;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;

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
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restUser;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestAttributesTransfer;

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
        /*$restUser = (new RestUserTransfer())
            ->setNaturalIdentifier('PS--19')
            ->setSurrogateIdentifier(19);*/

        $this->restUser->expects($this->atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn('PS--19');

        $this->restUser->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(19);

        $this->restRequest->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUser);



        $this->restReturnLabelRequestAttributesTransfer->expects($this->atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn('PS--CU-161');

        $this->restReturnLabelRequestAttributesTransfer->expects($this->atLeastOnce())
            ->method('getCompanyUnitAddressExternalReference')
            ->willReturn('37151a0e-006a-4c23-93d7-ad4e0d26d1be');

        $restResponse = $this->returnLabelProcessor->getReturnLabel(
            $this->restRequest,
            $this->restReturnLabelRequestAttributesTransfer
        );
    }
}
