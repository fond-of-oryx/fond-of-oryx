<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class SplittableCheckoutRestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutMapperMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErrorMessageMapperMock;

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
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestSplittableCheckoutErrorTransfer|MockObject $restSplittableCheckoutErrorTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface
     */
    protected $metadataMock;

    /**
     * @var \Generated\Shared\Transfer\RestErrorMessageTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restErrorMessageTransferMock;

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

        $this->restErrorMessageMapperMock = $this->getMockBuilder(RestErrorMessageMapperInterface::class)
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

        $this->restSplittableCheckoutErrorTransferMock = $this->getMockBuilder(RestSplittableCheckoutErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataMock = $this->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErrorMessageTransferMock = $this->getMockBuilder(RestErrorMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new SplittableCheckoutRestResponseBuilder(
            $this->restSplittableCheckoutMapperMock,
            $this->restErrorMessageMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateNotPlacedErrorRestResponse(): void
    {
        $localeName = 'en_US';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($localeName);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restErrorMessageMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableCheckoutErrorAndLocaleName')
            ->with($this->restSplittableCheckoutErrorTransferMock, $localeName)
            ->willReturn($this->restErrorMessageTransferMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with($this->restErrorMessageTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->createNotPlacedErrorRestResponse(
                //@phpstan-ignore-next-line
                new ArrayObject([$this->restSplittableCheckoutErrorTransferMock]),
                $this->restRequestMock,
            ),
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
