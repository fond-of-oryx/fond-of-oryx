<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Export;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManager;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepository;
use Generated\Shared\Transfer\ExportedOrderCollectionTransfer;
use Generated\Shared\Transfer\ExportedOrderConfigTransfer;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Generated\Shared\Transfer\UserTransfer;
use GuzzleHttp\Client;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderExportTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \GuzzleHttp\ClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $guzzleClientMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ExportedOrderCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $collectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\UserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $userTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ExportedOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $exportedOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ExportedOrderConfigTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $exportedOrderConfigTransferMock;

    /**
     * @var \Psr\Http\Message\ResponseInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $responseMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\Export\DataExportInterface
     */
    protected $exporter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->entityManagerMock = $this->getMockBuilder(JellyfishBufferEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(JellyfishBufferRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->guzzleClientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(JellyfishBufferConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(JellyfishBufferTableFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionTransferMock = $this->getMockBuilder(ExportedOrderCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportedOrderTransferMock = $this->getMockBuilder(ExportedOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->userTransferMock = $this->getMockBuilder(UserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportedOrderConfigTransferMock = $this->getMockBuilder(ExportedOrderConfigTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exporter = new OrderExport(
            $this->repositoryMock,
            $this->entityManagerMock,
            $this->loggerMock,
            $this->guzzleClientMock,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testExportFilterValidationStoreMissingException(): void
    {
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->filterTransferMock->expects(static::once())->method('getStore');

        $catch = null;
        try {
            $this->exporter->exportByFilter($this->exportedOrderConfigTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
        static::assertSame('Store in filter is required!', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testExportFilterValidationNoIdsNorRangeGivenException(): void
    {
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->filterTransferMock->expects(static::once())->method('getStore')->willReturn('test');
        $this->filterTransferMock->expects(static::once())->method('getIds');
        $this->filterTransferMock->expects(static::once())->method('getRangeTo')->willReturn(1);
        $this->filterTransferMock->expects(static::once())->method('getRangeFrom');

        $catch = null;
        try {
            $this->exporter->exportByFilter($this->exportedOrderConfigTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
        static::assertSame('Array of IDs or range from and range to has to be set!', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testExportByFilterWithoutEntries(): void
    {
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getSystemCode')->willReturn('test');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([1]);
        $this->repositoryMock->expects(static::once())->method('findBufferedOrders')->willReturn($this->collectionTransferMock);
        $this->loggerMock->expects(static::once())->method('notice')->with('Exporting "0" orders from buffer table for store "testStore" with system code override "test"');
        $this->collectionTransferMock->expects(static::once())->method('getCount')->willReturn(0);
        $this->collectionTransferMock->expects(static::once())->method('getOrders')->willReturn(new ArrayObject());

        $this->exporter->exportByFilter($this->exportedOrderConfigTransferMock);
    }

    /**
     * @return void
     */
    public function testExportByFilterWithDryRun(): void
    {
        $collection = new ArrayObject();
        $collection->append($this->exportedOrderTransferMock);

        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getUser')->willReturn($this->userTransferMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getSystemCode')->willReturn('test');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([1]);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getDryRun')->willReturn(true);
        $this->repositoryMock->expects(static::once())->method('findBufferedOrders')->willReturn($this->collectionTransferMock);
        $this->loggerMock->expects(static::exactly(2))->method('notice');
        $this->collectionTransferMock->expects(static::once())->method('getCount')->willReturn(1);
        $this->collectionTransferMock->expects(static::once())->method('getOrders')->willReturn($collection);
        $this->exportedOrderTransferMock->expects(static::atLeastOnce())->method('getData')->willReturn(json_encode(['body' => json_encode([])]));
        $this->exportedOrderTransferMock->expects(static::once())->method('setData')->with('{"body":"{\"systemCode\":\"test\"}"}')->willReturnSelf();
        $this->exportedOrderTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->guzzleClientMock->expects(static::never())->method('request');

        $this->exporter->exportByFilter($this->exportedOrderConfigTransferMock);
    }

    /**
     * @return void
     */
    public function testExportByFilter(): void
    {
        $collection = new ArrayObject();
        $collection->append($this->exportedOrderTransferMock);
        $self = $this;

        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getUser')->willReturn($this->userTransferMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getSystemCode')->willReturn('test');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([1]);
        $this->repositoryMock->expects(static::once())->method('findBufferedOrders')->willReturn($this->collectionTransferMock);
        $this->entityManagerMock->expects(static::once())->method('flagAsReexported');
        $this->loggerMock->expects(static::once())->method('notice');
        $this->collectionTransferMock->expects(static::once())->method('getCount')->willReturn(1);
        $this->collectionTransferMock->expects(static::once())->method('getOrders')->willReturn($collection);
        $this->exportedOrderTransferMock->expects(static::atLeastOnce())->method('getData')->willReturn(json_encode(['body' => json_encode([])]));
        $this->exportedOrderTransferMock->expects(static::once())->method('setData')->with('{"body":"{\"systemCode\":\"test\"}"}')->willReturnSelf();
        $this->exportedOrderTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->exportedOrderTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->responseMock->expects(static::once())->method('getStatusCode')->willReturn(Response::HTTP_OK);
        $this->guzzleClientMock->expects(static::once())->method('request')->willReturnCallback(static function ($type, $uri, $options) use ($self) {
            static::assertIsArray($options);
            static::assertArrayHasKey('body', $options);

            return $self->responseMock;
        });

        static::assertFalse($this->exporter->exportByFilter($this->exportedOrderConfigTransferMock));
    }

    /**
     * @return void
     */
    public function testExportMiddlewareNotReachable(): void
    {
        $collection = new ArrayObject();
        $collection->append($this->exportedOrderTransferMock);
        $self = $this;

        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getFilter')->willReturn($this->filterTransferMock);
        $this->exportedOrderConfigTransferMock->expects(static::atLeastOnce())->method('getUser')->willReturn($this->userTransferMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getSystemCode')->willReturn('test');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([1]);
        $this->repositoryMock->expects(static::once())->method('findBufferedOrders')->willReturn($this->collectionTransferMock);
        $this->entityManagerMock->expects(static::never())->method('flagAsReexported');
        $this->loggerMock->expects(static::once())->method('notice');
        $this->loggerMock->expects(static::once())->method('error');
        $this->collectionTransferMock->expects(static::once())->method('getCount')->willReturn(1);
        $this->collectionTransferMock->expects(static::once())->method('getOrders')->willReturn($collection);
        $this->exportedOrderTransferMock->expects(static::atLeastOnce())->method('getData')->willReturn(json_encode(['body' => json_encode([])]));
        $this->exportedOrderTransferMock->expects(static::once())->method('setData')->with('{"body":"{\"systemCode\":\"test\"}"}')->willReturnSelf();
        $this->exportedOrderTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->exportedOrderTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->responseMock->expects(static::exactly(2))->method('getStatusCode')->willReturn(Response::HTTP_BAD_GATEWAY);
        $this->guzzleClientMock->expects(static::once())->method('request')->willReturnCallback(static function ($type, $uri, $options) use ($self) {
            static::assertIsArray($options);
            static::assertArrayHasKey('body', $options);

            return $self->responseMock;
        });

        static::assertTrue($this->exporter->exportByFilter($this->exportedOrderConfigTransferMock));
    }
}
