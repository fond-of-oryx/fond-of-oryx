<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class BusinessOnBehalfRestApiZedStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestBusinessOnBehalfRequestTransfer|MockObject $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestBusinessOnBehalfResponseTransfer|MockObject $restBusinessOnBehalfResponseTransfer;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestSplittableTotalsResponseTransfer|MockObject $restSplittableTotalsResponseTransfer;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\Dependency\Client\BusinessOnBehalfRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfRestApiToZedRequestClientInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\Zed\BusinessOnBehalfRestApiZedStub
     */
    protected BusinessOnBehalfRestApiZedStub $splittableCheckoutRestApiZedStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restBusinessOnBehalfRequestTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfResponseTransfer = $this->getMockBuilder(RestBusinessOnBehalfResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsResponseTransfer = $this->getMockBuilder(RestSplittableTotalsResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(BusinessOnBehalfRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiZedStub = new BusinessOnBehalfRestApiZedStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUserByRestBusinessOnBehalfRequest(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/business-on-behalf-rest-api/gateway/set-default-company-user-by-rest-business-on-behalf-request',
                $this->restBusinessOnBehalfRequestTransferMock,
            )->willReturn($this->restBusinessOnBehalfResponseTransfer);

        static::assertEquals(
            $this->restBusinessOnBehalfResponseTransfer,
            $this->splittableCheckoutRestApiZedStub->setDefaultCompanyUserByRestBusinessOnBehalfRequest(
                $this->restBusinessOnBehalfRequestTransferMock,
            ),
        );
    }
}
