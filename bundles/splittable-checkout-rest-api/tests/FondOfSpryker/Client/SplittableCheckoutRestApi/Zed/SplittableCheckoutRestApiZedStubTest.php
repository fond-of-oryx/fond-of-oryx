<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiZedStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStub
     */
    protected $splittableCheckoutRestApiZedStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\CollaborativeCartsRestApi\Dependency\Client\CollaborativeCartsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    protected $restSplittableCheckoutRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this
            ->getMockBuilder(SplittableCheckoutRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestAttributesTransferMock = $this
            ->getMockBuilder(RestSplittableCheckoutRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransferMock = $this
            ->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiZedStub = new SplittableCheckoutRestApiZedStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->zedRequestClientMock->expects(self::atLeastOnce())
            ->method('call')
            ->with(
                '/splittable-checkout-rest-api/gateway/place-order',
                $this->restSplittableCheckoutRequestAttributesTransferMock
            )->willReturn($this->restSplittableCheckoutResponseTransferMock);

        $restSplittableCheckoutResponseTransfer = $this->splittableCheckoutRestApiZedStub
            ->placeOrder($this->restSplittableCheckoutRequestAttributesTransferMock);

        $this->assertInstanceOf(
            RestSplittableCheckoutResponseTransfer::class,
            $restSplittableCheckoutResponseTransfer
        );

        $this->assertEquals(
            $this->restSplittableCheckoutResponseTransferMock,
            $restSplittableCheckoutResponseTransfer
        );
    }
}
