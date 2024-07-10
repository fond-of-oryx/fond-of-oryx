<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    protected MockObject|RestErrorMessageTransfer $restErrorMessageTransfer;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\EasyApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiResponseTransfer|MockObject $easyApiResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Builder\RestResponseBuilder
     */
    protected RestResponseBuilder $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErrorMessageTransfer = $this->getMockBuilder(RestErrorMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransferMock = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder($this->restResourceBuilderMock);
    }

    /**
     * @return void
     */
    public function testBuildDocumentResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_OK)
            ->willReturnSelf();

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->willReturnSelf();

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatus')
            ->willReturn('success');

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(200);

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getHash')
            ->willReturn(sha1('test'));

        $this->easyApiResponseTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('test');

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildDocumentResponse($this->easyApiResponseTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testBuildErrorRestResponse(): void
    {
        $self = $this;
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->willReturnCallback(static function (RestErrorMessageTransfer $restErrorMessageTransfer) use ($self) {
                static::assertEquals((string)Response::HTTP_INTERNAL_SERVER_ERROR, $restErrorMessageTransfer->getCode());
                static::assertEquals(DocumentsRestApiConfig::ERROR_MESSAGE_UNEXPECTED, $restErrorMessageTransfer->getDetail());
                static::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $restErrorMessageTransfer->getStatus());

                return $self->restResponseMock;
            });

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildErrorRestResponse(),
        );
    }
}
