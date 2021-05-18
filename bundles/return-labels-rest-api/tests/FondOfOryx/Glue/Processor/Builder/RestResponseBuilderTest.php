<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapper;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestReturnLabelTransfer;
use Generated\Shared\Transfer\ReturnLabelTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilder;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Mapper\RestReturnLabelMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelMapperMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelTransferMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $builder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restReturnLabelMapperMock = $this->getMockBuilder(RestReturnLabelMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelTransferMock = $this->getMockBuilder(ReturnLabelTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelTransferMock = $this->getMockBuilder(RestReturnLabelTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->builder = new RestResponseBuilder(
            $this->restReturnLabelMapperMock,
            $this->restResourceBuilderMock
        );
    }

    /**
     * @return void
     */
    public function testCreateNotGeneratedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->willReturnSelf();

        static::assertEquals(
            $this->restResponseMock,
            $this->builder->createNotGeneratedRestResponse()
        );
    }

    /**
     * @return void
     */
    public function testCreateRestResponse(): void
    {
        $this->restReturnLabelMapperMock->expects(static::atLeastOnce())
            ->method('fromReturnLabel')
            ->with($this->returnLabelTransferMock)
            ->willReturn($this->restReturnLabelTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS, null, $this->restReturnLabelTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->restReturnLabelTransferMock)
            ->willReturnSelf();

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturnSelf();

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_OK)
            ->willReturnSelf();

        $this->builder->createRestResponse($this->returnLabelTransferMock);
    }
}
