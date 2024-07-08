<?php

namespace FondOfOryx\Zed\EasyApi\Dependency\Client;

use Codeception\Test\Unit;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;

class EasyApiToGuzzleClientBridgeTest extends Unit
{
    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ClientInterface|MockObject $clientMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ResponseInterface|MockObject $responseMock;

    /**
     * @var \FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientBridge
     */
    protected EasyApiToGuzzleClientBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new EasyApiToGuzzleClientBridge(
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testRequest(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('request')
            ->willReturn($this->responseMock);

        static::assertEquals(
            $this->responseMock,
            $this->bridge->request('post', 'test.de'),
        );
    }
}
