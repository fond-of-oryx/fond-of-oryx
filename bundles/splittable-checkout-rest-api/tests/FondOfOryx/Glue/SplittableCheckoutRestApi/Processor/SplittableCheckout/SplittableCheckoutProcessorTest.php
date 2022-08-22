<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClientInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Expander\RestSplittableCheckoutRequestExpanderInterface;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapperInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableCheckoutProcessorTest extends Unit
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
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder\SplittableCheckoutRestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\SplittableCheckout\SplittableCheckoutProcessor
     */
    protected $splittableCheckoutProcessor;

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

        $this->restResponseBuilderMock = $this->getMockBuilder(SplittableCheckoutRestResponseBuilderInterface::class)
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

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutProcessor = new SplittableCheckoutProcessor(
            $this->restSplittableCheckoutRequestMapperMock,
            $this->restSplittableCheckoutRequestExpanderMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->restSplittableCheckoutRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableCheckoutRequestAttributes')
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->restSplittableCheckoutRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSplittableCheckout')
            ->willReturn($this->splittableCheckoutTransferMock);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::never())
            ->method('getErrors');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($this->splittableCheckoutTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->splittableCheckoutProcessor->placeOrder(
                $this->restRequestMock,
                $this->restSplittableCheckoutRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrderWithError(): void
    {
        $restSplittableCheckoutErrorTransfers = new ArrayObject();

        $this->restSplittableCheckoutRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestSplittableCheckoutRequestAttributes')
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->restSplittableCheckoutRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->restRequestMock)
            ->willReturn($this->restSplittableCheckoutRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getSplittableCheckout')
            ->willReturn(null);

        $this->restSplittableCheckoutResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->restSplittableCheckoutResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErrors')
            ->willReturn($restSplittableCheckoutErrorTransfers);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('createNotPlacedErrorRestResponse')
            ->with($restSplittableCheckoutErrorTransfers, $this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->splittableCheckoutProcessor->placeOrder(
                $this->restRequestMock,
                $this->restSplittableCheckoutRequestAttributesTransferMock,
            ),
        );
    }
}
