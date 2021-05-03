<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeBridge;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeBridge;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceBridge;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig;
use Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Monolog\Logger;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class AvailabilityAlertAdapterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Monolog\Logger|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $dataWrapperTransferMock;

    /**
     * @var \GuzzleHttp\Stream\StreamInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $streamMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter\AvailabilityAlertAdapterInterface
     */
    protected $adapter;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->utilEncodingServiceMock = $this->getMockBuilder(JellyfishAvailabilityAlertToUtilEncodingServiceBridge::class)->disableOriginalConstructor()->getMock();
        $this->clientMock = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(JellyfishAvailabilityAlertConfig::class)->disableOriginalConstructor()->getMock();
        $this->storeFacadeMock = $this->getMockBuilder(JellyfishAvailabilityAlertToStoreFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->localeFacadeMock = $this->getMockBuilder(JellyfishAvailabilityAlertToLocaleFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->dataWrapperTransferMock = $this->getMockBuilder(AvailabilityAlertDataWrapperTransfer::class)->disableOriginalConstructor()->getMock();
        $this->responseMock = $this->getMockBuilder(Response::class)->disableOriginalConstructor()->getMock();
        $this->streamMock = $this->getMockBuilder(Stream::class)->disableOriginalConstructor()->getMock();

        $this->adapter = new class ($this->utilEncodingServiceMock, $this->clientMock, $this->configMock, $this->storeFacadeMock, $this->localeFacadeMock, $this->loggerMock) extends AvailabilityAlertAdapter
        {
            /**
             * @var \Monolog\Logger
             */
            protected $logger;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService
             * @param \GuzzleHttp\ClientInterface $client
             * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig $config
             * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface $storeFacade
             * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface $localeFacade
             * @param \Monolog\Logger $logger
             */
            public function __construct(
                JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService,
                ClientInterface $client,
                JellyfishAvailabilityAlertConfig $config,
                JellyfishAvailabilityAlertToStoreFacadeInterface $storeFacade,
                JellyfishAvailabilityAlertToLocaleFacadeInterface $localeFacade,
                Logger $logger
            ) {
                $this->logger = $logger;
                parent::__construct($utilEncodingService, $client, $config, $storeFacade, $localeFacade);
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Monolog\Logger
             */
            public function getLogger(?LoggerConfigInterface $loggerConfig = null): Logger
            {
                return $this->logger;
            }
        };
    }

    /**
     * @return void
     */
    public function testSendRequestDryRun(): void
    {
        $this->configMock->expects(static::once())->method('dryRun')->willReturn(true);
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getName')->willReturn('TestStore');
        $this->localeFacadeMock->expects(static::once())->method('getCurrentLocale')->willReturn($this->localeTransferMock);
        $this->localeTransferMock->expects(static::once())->method('getLocaleName')->willReturn('de_DE');
        $this->dataWrapperTransferMock->expects(static::once())->method('setConfiguration')->willReturn($this->dataWrapperTransferMock);
        $this->dataWrapperTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->loggerMock->expects(static::once())->method('error');
        $this->clientMock->expects(static::never())->method('request');
        $this->utilEncodingServiceMock->expects(static::once())->method('encodeJson')->willReturn('');

        $response = $this->adapter->sendRequest($this->dataWrapperTransferMock);

        static::assertNull($response);
    }

    /**
     * @return void
     */
    public function testSendRequest(): void
    {
        $this->configMock->expects(static::once())->method('dryRun')->willReturn(false);
        $this->configMock->expects(static::exactly(2))->method('getUsername')->willReturn('User');
        $this->configMock->expects(static::exactly(2))->method('getPassword')->willReturn('Pass');
        $this->configMock->expects(static::once())->method('getTimeout')->willReturn((float)4);
        $this->configMock->expects(static::once())->method('getBaseUri')->willReturn('www.xyz.de');
        $this->storeFacadeMock->expects(static::once())->method('getCurrentStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getName')->willReturn('TestStore');
        $this->localeFacadeMock->expects(static::once())->method('getCurrentLocale')->willReturn($this->localeTransferMock);
        $this->localeTransferMock->expects(static::once())->method('getLocaleName')->willReturn('de_DE');
        $this->dataWrapperTransferMock->expects(static::once())->method('setConfiguration')->willReturn($this->dataWrapperTransferMock);
        $this->dataWrapperTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->loggerMock->expects(static::never())->method('error');
        $this->loggerMock->expects(static::once())->method('info');
        $this->utilEncodingServiceMock->expects(static::exactly(2))->method('encodeJson')->willReturn('');
        $this->clientMock->expects(static::once())->method('request')->willReturn($this->responseMock);
        $this->responseMock->expects(static::once())->method('getBody')->willReturn($this->streamMock);

        $response = $this->adapter->sendRequest($this->dataWrapperTransferMock);

        static::assertNotNull($response);
    }
}
