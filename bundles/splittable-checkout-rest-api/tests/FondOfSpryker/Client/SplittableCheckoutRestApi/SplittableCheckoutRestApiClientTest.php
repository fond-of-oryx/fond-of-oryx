<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer;

class SplittableCheckoutRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiClient
     */
    protected $splittableCheckoutRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\SplittableCheckoutRestApi\SplittableCheckoutRestApiFactory
     */
    protected $splittableCheckoutRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\SplittableCheckoutRestApi\Zed\SplittableCheckoutRestApiZedStubInterface
     */
    protected $splittableCheckoutRestApiZedStubMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer
     */
    protected $restSplittableCheckoutRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestSplittableCheckoutResponseTransfer
     */
    protected $restSplittableCheckoutResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutRestApiFactoryMock = $this
            ->getMockBuilder(SplittableCheckoutRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiZedStubMock = $this
            ->getMockBuilder(SplittableCheckoutRestApiZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestAttributesTransferMock = $this
            ->getMockBuilder(RestSplittableCheckoutRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutResponseTransferMock = $this->getMockBuilder(RestSplittableCheckoutResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiClient = new SplittableCheckoutRestApiClient();
        $this->splittableCheckoutRestApiClient->setFactory($this->splittableCheckoutRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testPlaceOrder(): void
    {
        $this->splittableCheckoutRestApiFactoryMock->expects(self::atLeastOnce())
            ->method('createSplittableCheckoutRestApiZedStub')
            ->willReturn($this->splittableCheckoutRestApiZedStubMock);

        $this->splittableCheckoutRestApiZedStubMock->expects(self::atLeastOnce())
            ->method('placeOrder')
            ->with($this->restSplittableCheckoutRequestAttributesTransferMock)
            ->willReturn($this->restSplittableCheckoutResponseTransferMock);

        $restSplittableCheckoutResponseTransfer = $this->splittableCheckoutRestApiClient
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
