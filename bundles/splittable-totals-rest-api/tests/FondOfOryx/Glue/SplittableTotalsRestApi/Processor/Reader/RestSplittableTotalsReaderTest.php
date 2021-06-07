<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface;
use FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestMapperMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Expander\RestSplittableTotalsRequestExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestExpanderMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\SplittableTotalsRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader\RestSplittableTotalsReader
     */
    protected $restSplittableTotalsReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableTotalsRequestMapperMock = $this->getMockBuilder(RestSplittableTotalsRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestExpanderMock = $this->getMockBuilder(RestSplittableTotalsRequestExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(SplittableTotalsRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransferMock = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsTransferMock = $this->getMockBuilder(SplittableTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsReader = new RestSplittableTotalsReader(
            $this->restSplittableTotalsRequestMapperMock,
            $this->restSplittableTotalsRequestExpanderMock,
            $this->restResponseBuilderMock,
            $this->clientMock
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->restSplittableTotalsRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableTotalsRequestAttributes')
            ->willReturn($this->restSplittableTotalsRequestTransferMock);

        $this->restSplittableTotalsRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableTotalsRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableTotalsRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        $this->restSplittableTotalsResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->willReturn($this->splittableTotalsTransferMock);

        $this->restSplittableTotalsResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($this->splittableTotalsTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restSplittableTotalsReader->get(
                $this->restRequestMock,
                $this->restSplittableTotalsRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetWithError(): void
    {
        $this->restSplittableTotalsRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableTotalsRequestAttributes')
            ->willReturn($this->restSplittableTotalsRequestTransferMock);

        $this->restSplittableTotalsRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableTotalsRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableTotalsRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableTotalsRequestTransferMock)
            ->willReturn($this->restSplittableTotalsResponseTransferMock);

        $this->restSplittableTotalsResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->willReturn(null);

        $this->restSplittableTotalsResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('createNotFoundErrorRestResponse')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restSplittableTotalsReader->get(
                $this->restRequestMock,
                $this->restSplittableTotalsRequestAttributesTransferMock
            )
        );
    }
}
