<?php

namespace FondOfOryx\Client\NotionProxyRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class NotionProxyRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClient
     */
    protected NotionProxyRestApiClientInterface $client;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\Request\RequestInterface
     */
    protected RequestInterface $clientRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiFactory
     */
    protected MockObject|NotionProxyRestApiFactory $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer
     */
    protected MockObject|RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    protected MockObject|RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientRequestMock = $this
            ->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(NotionProxyRestApiFactory::class)
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

        $this->client = new NotionProxyRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSendRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRequestClient')
            ->willReturn($this->clientRequestMock);

        $this->clientRequestMock->expects(static::atLeastOnce())
            ->method('send')
            ->willReturn($this->restNotionProxyRequestResponseTransferMock);

        $restNotionProxyRequestResponseTransfer = $this->client
            ->sendRequest($this->restNotionProxyRequestAttributesTransferMock);

        static::assertEquals(
            $restNotionProxyRequestResponseTransfer,
            $this->restNotionProxyRequestResponseTransferMock,
        );
    }
}
