<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConstants;
use Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer;
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
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfErrorTransfer $restBusinessOnBehalfErrorTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilder
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

        $this->restBusinessOnBehalfErrorTransferMock = $this->getMockBuilder(RestBusinessOnBehalfErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
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
    public function testBuildEmptyRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_NO_CONTENT)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildEmptyRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testBuildErrorRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restBusinessOnBehalfErrorTransferMock->expects(static::atLeastOnce())
            ->method('getErrorCode')
            ->willReturn(BusinessOnBehalfRestApiConstants::ERROR_CODE_INVALID_COMPANY_USER);

        $this->restBusinessOnBehalfErrorTransferMock->expects(static::atLeastOnce())
            ->method('getMessage')
            ->willReturn(BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_INVALID_COMPANY_USER);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === BusinessOnBehalfRestApiConstants::ERROR_CODE_INVALID_COMPANY_USER
                            && $restErrorMessageTransfer->getDetail() === BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_INVALID_COMPANY_USER
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildErrorRestResponse(
                new ArrayObject([$this->restBusinessOnBehalfErrorTransferMock]),
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildErrorRestResponseWithEmptyErrors(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === BusinessOnBehalfRestApiConstants::ERROR_CODE_UNDEFINED_ERROR_OCCURRED
                            && $restErrorMessageTransfer->getDetail() === BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_UNDEFINED_ERROR_OCCURRED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildErrorRestResponse(new ArrayObject()),
        );
    }
}
