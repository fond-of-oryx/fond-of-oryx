<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableCheckoutRestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutMapperMock = $this->getMockBuilder(RestSplittableCheckoutMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutTransferMock = $this->getMockBuilder(RestSplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new SplittableCheckoutRestResponseBuilder(
            $this->restSplittableCheckoutMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateNotPlacedErrorRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === SplittableCheckoutRestApiConfig::RESPONSE_CODE_SPLITTABLE_CHECKOUT_NOT_PLACED
                            && $restErrorMessageTransfer->getDetail() === SplittableCheckoutRestApiConfig::EXCEPTION_MESSAGE_SPLITTABLE_CHECKOUT_NOT_PLACED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_UNPROCESSABLE_ENTITY;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->createNotPlacedErrorRestResponse(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRestResponse(): void
    {
        $this->restSplittableCheckoutMapperMock->expects(static::atLeastOnce())
            ->method('fromSplittableCheckout')
            ->with($this->splittableCheckoutTransferMock)
            ->willReturn($this->restSplittableCheckoutTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_CHECKOUT,
                null,
                $this->restSplittableCheckoutTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->restSplittableCheckoutTransferMock)
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
            $this->restResponseBuilder->createRestResponse($this->splittableCheckoutTransferMock),
        );
    }
}
