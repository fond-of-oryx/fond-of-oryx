<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClientInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapperInterface;
use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CartReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerReferenceFilterMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListMapperMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface|mixed
     */
    protected $metadataMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $quoteListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReader
     */
    protected $cartReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerReferenceFilterMock = $this->getMockBuilder(CustomerReferenceFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListMapperMock = $this->getMockBuilder(QuoteListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CartSearchRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataMock = $this->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartReader = new CartReader(
            $this->customerReferenceFilterMock,
            $this->quoteListMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $customerReference = 'FOO-C--1';
        $locale = 'de_DE';

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->quoteListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->quoteListTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findQuotes')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->quoteListTransferMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCartSearchRestResponse')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->cartReader->find($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(null);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->quoteListMapperMock->expects(static::never())
            ->method('fromRestRequest');

        $this->clientMock->expects(static::never())
            ->method('findQuotes');

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCartSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->cartReader->find($this->restRequestMock),
        );
    }
}
