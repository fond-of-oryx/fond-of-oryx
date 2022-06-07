<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCartSearchPaginationTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|mixed
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchPaginationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Translator\RestCartSearchAttributesTranslatorInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCartSearchAttributesTranslatorMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCartSearchAttributesMapperMock = $this->getMockBuilder(RestCartSearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchAttributesTransferMock = $this->getMockBuilder(RestCartSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchPaginationTransferMock = $this->getMockBuilder(RestCartSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchAttributesTranslatorMock = $this->getMockBuilder(RestCartSearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restCartSearchAttributesTranslatorMock,
            $this->restCartSearchAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildCartSearchRestResponse(): void
    {
        $locale = 'de_DE';
        $numFound = 100;

        $this->restCartSearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromQuoteList')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->restCartSearchAttributesTransferMock);

        $this->restCartSearchAttributesTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restCartSearchAttributesTransferMock)
            ->willReturn($this->restCartSearchAttributesTransferMock);

        $this->restCartSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restCartSearchPaginationTransferMock);

        $this->restCartSearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CartSearchRestApiConfig::RESOURCE_CART_SEARCH,
                null,
                $this->restCartSearchAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCartSearchRestResponse(
                $this->quoteListTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildUseIsNotSpecifiedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CartSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === CartSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse(),
        );
    }
}
