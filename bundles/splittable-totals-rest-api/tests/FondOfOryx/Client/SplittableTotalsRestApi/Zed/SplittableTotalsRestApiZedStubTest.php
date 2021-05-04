<?php

namespace FondOfOryx\Client\SplittableTotalsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;

class SplittableTotalsRestApiZedStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsResponseTransfer;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\Dependency\Client\SplittableTotalsRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\SplittableTotalsRestApi\Zed\SplittableTotalsRestApiZedStub
     */
    protected $splittableTotalsRestApiZedStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransfer = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(SplittableTotalsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRestApiZedStub = new SplittableTotalsRestApiZedStub(
            $this->zedRequestClientMock
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
                '/splittable-totals-rest-api/gateway/get-splittable-totals',
                $this->restSplittableTotalsRequestTransferMock
            )->willReturn($this->restSplittableTotalsResponseTransfer);

        static::assertEquals(
            $this->restSplittableTotalsResponseTransfer,
            $this->splittableTotalsRestApiZedStub->getSplittableTotals($this->restSplittableTotalsRequestTransferMock)
        );
    }
}
