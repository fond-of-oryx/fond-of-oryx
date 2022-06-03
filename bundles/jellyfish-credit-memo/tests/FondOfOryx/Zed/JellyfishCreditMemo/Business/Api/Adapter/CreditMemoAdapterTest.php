<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceBridge;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use GuzzleHttp\ClientInterface;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CreditMemoAdapterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Service\JellyfishCreditMemoToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishCreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishCreditMemoTransferMock;

    /**
     * @var \Psr\Http\Message\StreamInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $streamInterfaceMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseInterfaceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface
     */
    protected $adapter;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->utilEncodingServiceMock = $this->getMockBuilder(JellyfishCreditMemoToUtilEncodingServiceBridge::class)->disableOriginalConstructor()->getMock();
        $this->clientMock = $this->getMockBuilder(ClientInterface::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(JellyfishCreditMemoConfig::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->jellyfishCreditMemoTransferMock = $this->getMockBuilder(JellyfishCreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->streamInterfaceMock = $this->getMockBuilder(StreamInterface::class)->disableOriginalConstructor()->getMock();
        $this->responseInterfaceMock = $this->getMockBuilder(ResponseInterface::class)->disableOriginalConstructor()->getMock();

        $this->adapter = new CreditMemoAdapter($this->utilEncodingServiceMock, $this->clientMock, $this->configMock, $this->loggerMock);
    }

    /**
     * @return void
     */
    public function testSendRequestDryRun(): void
    {
        $this->configMock->expects(static::once())->method('dryRun')->willReturn(true);
        $this->loggerMock->expects(static::once())->method('error');
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->utilEncodingServiceMock->expects(static::once())->method('encodeJson')->willReturn('');

        $response = $this->adapter->sendRequest($this->jellyfishCreditMemoTransferMock);
        static::assertNull($response);
    }

    /**
     * @return void
     */
    public function testSendRequest(): void
    {
        $this->configMock->expects(static::once())->method('dryRun')->willReturn(false);
        $this->configMock->expects(static::once())->method('getUsername')->willReturn('User');
        $this->configMock->expects(static::once())->method('getPassword')->willReturn('Pass');
        $this->loggerMock->expects(static::never())->method('error');
        $this->loggerMock->expects(static::once())->method('info');
        $this->clientMock->expects(static::once())->method('request')->willReturn($this->responseInterfaceMock);
        $this->responseInterfaceMock->expects(static::once())->method('getStatusCode')->willReturn(200);
        $this->responseInterfaceMock->expects(static::once())->method('getBody')->willReturn($this->streamInterfaceMock);
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->utilEncodingServiceMock->expects(static::exactly(2))->method('encodeJson')->willReturn('');

        $response = $this->adapter->sendRequest($this->jellyfishCreditMemoTransferMock);
        static::assertSame($response, $this->streamInterfaceMock);
    }

    /**
     * @return void
     */
    public function testSendRequestThrowsException(): void
    {
        $this->configMock->expects(static::once())->method('dryRun')->willReturn(false);
        $this->configMock->expects(static::once())->method('getUsername')->willReturn('User');
        $this->configMock->expects(static::once())->method('getPassword')->willReturn('Pass');
        $this->loggerMock->expects(static::never())->method('error');
        $this->loggerMock->expects(static::once())->method('info');
        $this->clientMock->expects(static::once())->method('request')->willReturn($this->responseInterfaceMock);
        $this->responseInterfaceMock->expects(static::once())->method('getStatusCode')->willReturn(500);
        $this->responseInterfaceMock->expects(static::never())->method('getBody');
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->utilEncodingServiceMock->expects(static::exactly(2))->method('encodeJson')->willReturn('');

        $catch = null;

        try {
            $this->adapter->sendRequest($this->jellyfishCreditMemoTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }
        static::assertNotNull($catch);
    }
}
