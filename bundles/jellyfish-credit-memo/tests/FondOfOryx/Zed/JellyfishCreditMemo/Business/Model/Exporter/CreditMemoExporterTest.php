<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapter;
use FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapper;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig;
use FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManager;
use FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepository;
use Generated\Shared\Transfer\CreditMemoCollectionTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemStateTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Monolog\Logger;

class CreditMemoExporterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter\CreditMemoAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $adapterMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishCreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishCreditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransfer;

    /**
     * @var \Generated\Shared\Transfer\ItemStateTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemStateTransfer;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Exporter\CreditMemoExporterInterface
     */
    protected $exporter;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->adapterMock = $this->getMockBuilder(CreditMemoAdapter::class)->disableOriginalConstructor()->getMock();
        $this->entityManagerMock = $this->getMockBuilder(JellyfishCreditMemoEntityManager::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(JellyfishCreditMemoConfig::class)->disableOriginalConstructor()->getMock();
        $this->loggerMock = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->jellyfishCreditMemoTransferMock = $this->getMockBuilder(JellyfishCreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->itemTransfer = $this->getMockBuilder(ItemTransfer::class)->disableOriginalConstructor()->getMock();
        $this->itemStateTransfer = $this->getMockBuilder(ItemStateTransfer::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoCollectionTransferMock = $this->getMockBuilder(CreditMemoCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoMapperMock = $this->getMockBuilder(JellyfishCreditMemoMapper::class)->disableOriginalConstructor()->getMock();
        $this->repositoryMock = $this->getMockBuilder(JellyfishCreditMemoRepository::class)->disableOriginalConstructor()->getMock();

        $this->exporter = new CreditMemoExporter($this->creditMemoMapperMock, $this->repositoryMock, $this->configMock, $this->entityManagerMock, $this->adapterMock, $this->loggerMock);
    }

    /**
     * @return void
     */
    public function testExportWithNothingFoundForExport(): void
    {
        $this->repositoryMock->expects(static::once())->method('findPendingCreditMemoCollection')->willReturn($this->creditMemoCollectionTransferMock);
        $this->creditMemoCollectionTransferMock->expects(static::once())->method('getCreditMemos')->willReturn(new ArrayObject());
        $this->adapterMock->expects(static::never())->method('sendRequest');

        $this->exporter->export();
    }

    /**
     * @return void
     */
    public function testExportWithoutItems(): void
    {
        $this->repositoryMock->expects(static::once())->method('findPendingCreditMemoCollection')->willReturn($this->creditMemoCollectionTransferMock);
        $this->creditMemoCollectionTransferMock->expects(static::exactly(2))->method('getCreditMemos')->willReturn(new ArrayObject([$this->creditMemoTransferMock]));
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn(new ArrayObject());
        $this->adapterMock->expects(static::never())->method('sendRequest');

        $this->exporter->export();
    }

    /**
     * @return void
     */
    public function testExportWithIsNotValidForExport(): void
    {
        $this->repositoryMock->expects(static::once())->method('findPendingCreditMemoCollection')->willReturn($this->creditMemoCollectionTransferMock);
        $this->creditMemoCollectionTransferMock->expects(static::exactly(2))->method('getCreditMemos')->willReturn(new ArrayObject([$this->creditMemoTransferMock]));
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getItems')->willReturn(new ArrayObject([$this->itemTransfer]));
        $this->configMock->expects(static::once())->method('getSalesOrderItemStateRefunded')->willReturn('refunded');
        $this->repositoryMock->expects(static::once())->method('findSalesOrderItemStateByIdSalesOrderItem')->willReturn(null);
        $this->adapterMock->expects(static::never())->method('sendRequest');

        $this->exporter->export();
    }

    /**
     * @return void
     */
    public function testExport(): void
    {
        $this->repositoryMock->expects(static::once())->method('findPendingCreditMemoCollection')->willReturn($this->creditMemoCollectionTransferMock);
        $this->creditMemoCollectionTransferMock->expects(static::exactly(2))->method('getCreditMemos')->willReturn(new ArrayObject([$this->creditMemoTransferMock]));
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getItems')->willReturn(new ArrayObject([$this->itemTransfer]));
        $this->repositoryMock->expects(static::once())->method('findSalesOrderItemStateByIdSalesOrderItem')->willReturn($this->itemStateTransfer);
        $this->itemStateTransfer->expects(static::once())->method('getName')->willReturn('test');
        $this->configMock->expects(static::once())->method('getSalesOrderItemStateRefunded')->willReturn('test');
        $this->creditMemoMapperMock->expects(static::once())->method('mapCreditMemoTransferToJellyfishCreditMemoTransfer')->willReturn($this->jellyfishCreditMemoTransferMock);
        $this->adapterMock->expects(static::once())->method('sendRequest');
        $this->jellyfishCreditMemoTransferMock->expects(static::once())->method('setExportState');
        $this->entityManagerMock->expects(static::once())->method('updateExportState');

        $this->exporter->export();
    }

    /**
     * @return void
     */
    public function testExportThrowsException(): void
    {
        $this->repositoryMock->expects(static::once())->method('findPendingCreditMemoCollection')->willThrowException(new Exception());
        $this->adapterMock->expects(static::never())->method('sendRequest');

        $catch = null;

        try {
            $this->exporter->export();
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
    }

    /**
     * @return void
     */
    public function testExportBySalesOrderIdAndSalesOrderItemIdsWithNothingFoundForExport(): void
    {
        $this->repositoryMock->expects(static::once())->method('findCreditMemoBySalesOrderIdAndSalesOrderItemIds')->willReturn(null);
        $this->adapterMock->expects(static::never())->method('sendRequest');

        $this->exporter->exportBySalesOrderIdAndSalesOrderItemIds(1, []);
    }
}
