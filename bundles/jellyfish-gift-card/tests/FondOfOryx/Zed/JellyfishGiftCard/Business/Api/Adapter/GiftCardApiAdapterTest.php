<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Service\JellyfishGiftCardToUtilEncodingServiceInterface;
use Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class GiftCardApiAdapterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\GuzzleHttp\ClientInterface
     */
    protected $httpClientMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Service\JellyfishGiftCardToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardDataWrapperTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ResponseInterface
     */
    protected $responseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\StreamInterface
     */
    protected $streamMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapter
     */
    protected $giftCardApiAdapter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->httpClientMock = $this->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(JellyfishGiftCardToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataWrapperTransferMock = $this->getMockBuilder(JellyfishGiftCardDataWrapperTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(StreamInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardApiAdapter = new GiftCardApiAdapter(
            $this->httpClientMock,
            $this->utilEncodingServiceMock,
            $this->loggerMock
        );
    }

    /**
     * @return void
     */
    public function testPost(): void
    {
        $bodyAsArray = ['data' => []];
        $body = '{"data": {}}';

        $this->jellyfishGiftCardDataWrapperTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->with(true, true)
            ->willReturn($bodyAsArray);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($bodyAsArray)
            ->willReturn($body);

        $this->httpClientMock->expects(static::atLeastOnce())
            ->method('request')
            ->with(
                'POST',
                '/',
                [
                    RequestOptions::BODY => $body,
                ]
            )->willReturn($this->responseMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(204);

        $this->responseMock->expects(static::never())
            ->method('getBody');

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->giftCardApiAdapter->post($this->jellyfishGiftCardDataWrapperTransferMock);
    }

    /**
     * @return void
     */
    public function testPostWithError(): void
    {
        $bodyAsArray = ['data' => []];
        $body = '{"data": {}}';
        $responseBody = '404 Not Found...';

        $this->jellyfishGiftCardDataWrapperTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->with(true, true)
            ->willReturn($bodyAsArray);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with($bodyAsArray)
            ->willReturn($body);

        $this->httpClientMock->expects(static::atLeastOnce())
            ->method('request')
            ->with(
                'POST',
                '/',
                [
                    RequestOptions::BODY => $body,
                ]
            )->willReturn($this->responseMock);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn(404);

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getBody')
            ->willReturn($responseBody);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error')
            ->with(
                'Could not export gift card.',
                static::callback(
                    static function (array $context) use ($body) {
                        return isset($context['exception'], $context['request']['body'])
                            && $context['exception'] instanceof Throwable
                            && $context['request']['body'] === $body;
                    }
                )
            );

        $this->giftCardApiAdapter->post($this->jellyfishGiftCardDataWrapperTransferMock);
    }
}
