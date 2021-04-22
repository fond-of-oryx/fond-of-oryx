<?php

namespace FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class OneTimePasswordRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\Dependency\Client\OneTimePasswordRestApiToZedRequestClientBridge
     */
    protected $oneTimePasswordRestApiToZedRequestClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = 'url';

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiToZedRequestClientBridge = new OneTimePasswordRestApiToZedRequestClientBridge(
            $this->zedRequestClientMock
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientMock->expects($this->atLeastOnce())
            ->method('call')
            ->with($this->url, $this->transferMock)
            ->willReturn($this->transferMock);

        $this->assertInstanceOf(
            TransferInterface::class,
            $this->oneTimePasswordRestApiToZedRequestClientBridge->call(
                $this->url,
                $this->transferMock
            )
        );
    }
}
