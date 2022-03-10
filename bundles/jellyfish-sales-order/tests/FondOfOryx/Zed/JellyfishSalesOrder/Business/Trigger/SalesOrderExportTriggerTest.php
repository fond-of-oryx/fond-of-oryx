<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Trigger;

use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishSalesOrder\JellyfishSalesOrderConstants;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrder;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderItem;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;

class SalesOrderExportTriggerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $omsFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $queryContainerMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface|mixed
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $storeTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\Base\SpySalesOrderQuery|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $salesOrderQueryMock;

    /**
     * @var array<mixed>|array<\PHPUnit\Framework\MockObject\MockObject>|array<\Orm\Zed\Sales\Persistence\Base\SpySalesOrder>
     */
    protected $salesOrderEntityMocks;

    /**
     * @var array<mixed>|array<\PHPUnit\Framework\MockObject\MockObject>|array<\Orm\Zed\Sales\Persistence\Base\SpySalesOrderItem>
     */
    protected $salesOrderItemEntityMocks;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Trigger\SalesOrderExportTrigger
     */
    protected $salesOrderExportTrigger;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->omsFacadeMock = $this->getMockBuilder(JellyfishSalesOrderToOmsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(JellyfishSalesOrderToStoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(JellyfishSalesOrderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerMock = $this->getMockBuilder(JellyfishSalesOrderQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(JellyfishSalesOrderRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderQueryMock = $this->getMockBuilder(SpySalesOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderEntityMocks = [
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->salesOrderItemEntityMocks = [
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->salesOrderExportTrigger = new class (
            $this->omsFacadeMock,
            $this->storeFacadeMock,
            $this->configMock,
            $this->queryContainerMock,
            $this->repositoryMock,
            $this->loggerMock
        ) extends SalesOrderExportTrigger {
            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $logger;

            /**
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeInterface $omsFacade
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeInterface $storeFacade
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig $config
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderQueryContainerInterface $queryContainer
             * @param \FondOfOryx\Zed\JellyfishSalesOrder\Persistence\JellyfishSalesOrderRepositoryInterface $repository
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(
                JellyfishSalesOrderToOmsFacadeInterface $omsFacade,
                JellyfishSalesOrderToStoreFacadeInterface $storeFacade,
                JellyfishSalesOrderConfig $config,
                JellyfishSalesOrderQueryContainerInterface $queryContainer,
                JellyfishSalesOrderRepositoryInterface $repository,
                LoggerInterface $logger
            ) {
                parent::__construct($omsFacade, $storeFacade, $config, $queryContainer, $repository);

                $this->logger = $logger;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->logger;
            }
        };
    }

    /**
     * @return void
     */
    public function testTrigger(): void
    {
        $idOmsOrderItemState = 1;
        $storeName = 'FOO';
        $salesOrderItemEntityCollection = new ObjectCollection($this->salesOrderItemEntityMocks);
        $data = [];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportPendingStateName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOmsOrderItemStateByName')
            ->with(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT)
            ->willReturn($idOmsOrderItemState);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->queryContainerMock->expects(static::atLeastOnce())
            ->method('querySalesOrderByIdOmsOrderItemStateAndStoreName')
            ->with($idOmsOrderItemState, $storeName)
            ->willReturn($this->salesOrderQueryMock);

        $this->salesOrderQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn(new ObjectCollection($this->salesOrderEntityMocks));

        $this->salesOrderEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($salesOrderItemEntityCollection);

        $this->salesOrderItemEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn($idOmsOrderItemState);

        $this->salesOrderItemEntityMocks[1]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn($idOmsOrderItemState);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportEventName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_EVENT_NAME_DEFAULT);

        $this->omsFacadeMock->expects(static::atLeastOnce())
            ->method('triggerEvent')
            ->with(
                JellyfishSalesOrderConstants::EXPORT_EVENT_NAME_DEFAULT,
                $salesOrderItemEntityCollection,
                static::callback(
                    static function (array $logContext) {
                        return count($logContext) === 0;
                    },
                ),
            )->willReturn($data);

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->salesOrderExportTrigger->trigger();
    }

    /**
     * @return void
     */
    public function testTriggerWithNonExistingStateName(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportPendingStateName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOmsOrderItemStateByName')
            ->with(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT)
            ->willReturn(null);

        $this->storeFacadeMock->expects(static::never())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->queryContainerMock->expects(static::never())
            ->method('querySalesOrderByIdOmsOrderItemStateAndStoreName');

        $this->configMock->expects(static::never())
            ->method('getExportEventName');

        $this->omsFacadeMock->expects(static::never())
            ->method('triggerEvent');

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->salesOrderExportTrigger->trigger();
    }

    /**
     * @return void
     */
    public function testTriggerWithoutCurrentStore(): void
    {
        $idOmsOrderItemState = 1;

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportPendingStateName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOmsOrderItemStateByName')
            ->with(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT)
            ->willReturn($idOmsOrderItemState);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn(null);

        $this->queryContainerMock->expects(static::never())
            ->method('querySalesOrderByIdOmsOrderItemStateAndStoreName');

        $this->salesOrderQueryMock->expects(static::never())
            ->method('find');

        $this->configMock->expects(static::never())
            ->method('getExportEventName');

        $this->omsFacadeMock->expects(static::never())
            ->method('triggerEvent');

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->salesOrderExportTrigger->trigger();
    }

    /**
     * @return void
     */
    public function testTriggerWithDifferentItemStates(): void
    {
        $idOmsOrderItemState = 1;
        $storeName = 'FOO';
        $salesOrderItemEntityCollection = new ObjectCollection($this->salesOrderItemEntityMocks);
        $data = [];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportPendingStateName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOmsOrderItemStateByName')
            ->with(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT)
            ->willReturn($idOmsOrderItemState);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->queryContainerMock->expects(static::atLeastOnce())
            ->method('querySalesOrderByIdOmsOrderItemStateAndStoreName')
            ->with($idOmsOrderItemState, $storeName)
            ->willReturn($this->salesOrderQueryMock);

        $this->salesOrderQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn(new ObjectCollection($this->salesOrderEntityMocks));

        $this->salesOrderEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($salesOrderItemEntityCollection);

        $this->salesOrderItemEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn($idOmsOrderItemState);

        $this->salesOrderItemEntityMocks[1]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn(4);

        $this->configMock->expects(static::never())
            ->method('getExportEventName');

        $this->omsFacadeMock->expects(static::never())
            ->method('triggerEvent');

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->salesOrderExportTrigger->trigger();
    }

    /**
     * @return void
     */
    public function testTriggerWithInternalOmsFailure(): void
    {
        $idOmsOrderItemState = 1;
        $storeName = 'FOO';
        $salesOrderItemEntityCollection = new ObjectCollection($this->salesOrderItemEntityMocks);
        $data = null;

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportPendingStateName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdOmsOrderItemStateByName')
            ->with(JellyfishSalesOrderConstants::EXPORT_PENDING_STATE_NAME_DEFAULT)
            ->willReturn($idOmsOrderItemState);

        $this->storeFacadeMock->expects(static::atLeastOnce())
            ->method('getCurrentStore')
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($storeName);

        $this->queryContainerMock->expects(static::atLeastOnce())
            ->method('querySalesOrderByIdOmsOrderItemStateAndStoreName')
            ->with($idOmsOrderItemState, $storeName)
            ->willReturn($this->salesOrderQueryMock);

        $this->salesOrderQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn(new ObjectCollection($this->salesOrderEntityMocks));

        $this->salesOrderEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn($salesOrderItemEntityCollection);

        $this->salesOrderItemEntityMocks[0]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn($idOmsOrderItemState);

        $this->salesOrderItemEntityMocks[1]->expects(static::atLeastOnce())
            ->method('getFkOmsOrderItemState')
            ->willReturn($idOmsOrderItemState);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getExportEventName')
            ->willReturn(JellyfishSalesOrderConstants::EXPORT_EVENT_NAME_DEFAULT);

        $this->omsFacadeMock->expects(static::atLeastOnce())
            ->method('triggerEvent')
            ->with(
                JellyfishSalesOrderConstants::EXPORT_EVENT_NAME_DEFAULT,
                $salesOrderItemEntityCollection,
                static::callback(
                    static function (array $logContext) {
                        return count($logContext) === 0;
                    },
                ),
            )->willReturn($data);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error');

        $this->salesOrderExportTrigger->trigger();
    }
}
