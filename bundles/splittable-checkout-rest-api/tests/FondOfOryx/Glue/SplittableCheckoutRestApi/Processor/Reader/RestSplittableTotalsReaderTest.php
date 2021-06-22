<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestSplittableTotalsReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestMapperMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestExpanderMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableTotalsRestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

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
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Reader\SplittableTotalsReader
     */
    protected $splittableTotalsReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestMapperMock = $this->getMockBuilder(RestSplittableCheckoutRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestExpanderMock = $this->getMockBuilder(RestSplittableCheckoutRequestExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(SplittableTotalsRestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(SplittableCheckoutRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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

        $this->splittableTotalsReader = new SplittableTotalsReader(
            $this->restSplittableCheckoutRequestMapperMock,
            $this->restSplittableCheckoutRequestExpanderMock,
            $this->restResponseBuilderMock,
            $this->clientMock
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->restSplittableCheckoutRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableCheckoutRequestAttributes')
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->restSplittableCheckoutRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableCheckoutRequestTransferMock)
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
            $this->splittableTotalsReader->get(
                $this->restRequestMock,
                $this->restSplittableCheckoutRequestAttributesTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetWithError(): void
    {
        $this->restSplittableCheckoutRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableCheckoutRequestAttributes')
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->restSplittableCheckoutRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getSplittableTotals')
            ->with($this->restSplittableCheckoutRequestTransferMock)
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
            $this->splittableTotalsReader->get(
                $this->restRequestMock,
                $this->restSplittableCheckoutRequestAttributesTransferMock
            )
        );
    }
}
