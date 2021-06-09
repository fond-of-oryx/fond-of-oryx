<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(SplittableCheckoutRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(SplittableCheckoutRestApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new SplittableCheckoutRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSplittableCheckoutRestApiZedStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        static::assertEquals(
            $this->restSplittableCheckoutResponseTransferMock,
            $this->client->placeOrder($this->restSplittableCheckoutRequestTransferMock)
        );
    }
}
