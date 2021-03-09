<?php

namespace FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class SplittableCheckoutRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var \FondOfOryx\Client\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToZedRequestClientBridge
     */
    protected $splittableCheckoutRestApiToZedRequestClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutRestApiToZedRequestClientBridge =
            new SplittableCheckoutRestApiToZedRequestClientBridge($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $url = '';

        $this->zedRequestClientMock->expects(self::atLeastOnce())
            ->method('call')
            ->with($url, $this->transferMock)
            ->willReturn($this->transferMock);

        $transfer = $this->splittableCheckoutRestApiToZedRequestClientBridge->call($url, $this->transferMock);

        $this->assertInstanceOf(
            TransferInterface::class,
            $transfer
        );

        $this->assertEquals($this->transferMock, $transfer);
    }
}
