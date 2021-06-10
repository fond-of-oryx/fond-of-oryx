<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableCheckoutRestApiZedStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutResponseTransfer;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransfer;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStub
     */
    protected $splittableCheckoutRestApiZedStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransfer = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransfer = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(SplittableCheckoutRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiZedStub = new SplittableCheckoutRestApiZedStub(
            $this->zedRequestClientMock
        );
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/splittable-checkout-rest-api/gateway/place-order',
                $this->restSplittableCheckoutRequestTransferMock
            )->willReturn($this->restSplittableCheckoutResponseTransfer);

        static::assertEquals(
            $this->restSplittableCheckoutResponseTransfer,
            $this->splittableCheckoutRestApiZedStub->placeOrder($this->restSplittableCheckoutRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetSplittableTotals(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/splittable-checkout-rest-api/gateway/get-splittable-totals',
                $this->restSplittableCheckoutRequestTransferMock
            )->willReturn($this->restSplittableTotalsResponseTransfer);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransfer,
            $this->splittableCheckoutRestApiZedStub->getSplittableTotals($this->restSplittableCheckoutRequestTransferMock)
        );
    }
}
