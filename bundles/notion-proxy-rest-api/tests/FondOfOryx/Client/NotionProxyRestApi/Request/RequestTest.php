<?php

namespace FondOfOryx\Client\NotionProxyRestApi\Request;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class RequestTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\GuzzleHttp\Client
     */
    protected MockObject|Client $guzzleHttpClientMock;

    /**
     * @var \FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ResponseInterface
     */
    protected MockObject|ResponseInterface $responseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer
     */
    protected MockObject|RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    protected MockObject|RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransferMock;

    /**
     * var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\StreamInterface
     */
    protected MockObject|StreamInterface $streamMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->guzzleHttpClientMock = $this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this
            ->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restNotionProxyRequestAttributesTransferMock = $this
            ->getMockBuilder(RestNotionProxyRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restNotionProxyRequestResponseTransferMock = $this
            ->getMockBuilder(RestNotionProxyRequestResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this
            ->getMockBuilder(StreamInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = new Request($this->guzzleHttpClientMock);
    }

    /**
     * @return void
     */
    public function testSend(): void
    {
        $method = 'POST';
        $path = 'path';

        $this->restNotionProxyRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn($method);

        $this->restNotionProxyRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPath')
            ->willReturn($path);

        $this->restNotionProxyRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('{}');

        $this->guzzleHttpClientMock->expects(static::atLeastOnce())
            ->method('request')
            ->with($method, $path, ['json' => '{}'])
            ->willReturn($this->responseMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn('200');

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($this->streamMock);

        $this->streamMock->expects(static::atLeastOnce())
            ->method('getContents')
            ->willReturn('content');

        $restNotionProxyRequestResponseTransfer = $this->request
            ->send($this->restNotionProxyRequestAttributesTransferMock);

        static::assertInstanceOf(
            RestNotionProxyRequestResponseTransfer::class,
            $restNotionProxyRequestResponseTransfer,
        );

        static::assertEquals($restNotionProxyRequestResponseTransfer->getStatus(), '200');
        static::assertNull($restNotionProxyRequestResponseTransfer->getData());
    }
}
