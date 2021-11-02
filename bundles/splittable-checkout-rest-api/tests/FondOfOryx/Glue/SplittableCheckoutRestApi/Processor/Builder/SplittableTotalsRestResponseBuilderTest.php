<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableTotalsRestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableTotalsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableTotalsMapperMock = $this->getMockBuilder(RestSplittableTotalsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsTransferMock = $this->getMockBuilder(RestSplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new SplittableTotalsRestResponseBuilder(
            $this->restSplittableTotalsMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateNotFoundErrorRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === SplittableCheckoutRestApiConfig::RESPONSE_CODE_SPLITTABLE_TOTALS_NOT_FOUND
                            && $restErrorMessageTransfer->getDetail() === SplittableCheckoutRestApiConfig::EXCEPTION_MESSAGE_SPLITTABLE_TOTALS_NOT_FOUND
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_UNPROCESSABLE_ENTITY;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->createNotFoundErrorRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRestResponse(): void
    {
        $this->restSplittableTotalsMapperMock->expects(static::atLeastOnce())
            ->method('fromSplittableTotals')
            ->with($this->splittableTotalsTransferMock)
            ->willReturn($this->restSplittableTotalsTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_TOTALS,
                null,
                $this->restSplittableTotalsTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->restSplittableTotalsTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('setStatus')
            ->with(Response::HTTP_CREATED)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->createRestResponse($this->splittableTotalsTransferMock),
        );
    }
}
