<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpOrderTotalsWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginExecutorMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerFactoryMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $handlerMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpOrderEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderTotalsPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerFactoryMock = $this->getMockBuilder(TransactionHandlerFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handlerMock = $this->getMockBuilder(PropelDatabaseTransactionHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handlerMock->expects($this->atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($closure) {
                    return $closure();
                },
            );

        $this->transactionHandlerFactoryMock->method('createHandler')->willReturn($this->handlerMock);

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpOrderTotalsWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface $erpOrderPluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpOrderEntityManagerInterface $entityManager,
                ErpOrderTotalsPluginExecutorInterface $erpOrderPluginExecutor
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $erpOrderPluginExecutor);
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected function createTransactionHandlerFactory()
            {
                return $this->thFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->writer->create($this->erpOrderTotalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testCreateNotSuccessful(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willThrowException(new Exception());

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins');

        try {
            $this->writer->create($this->erpOrderTotalsTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->writer->update($this->erpOrderTotalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccessful(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrderTotals')
            ->willThrowException(new Exception());

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins');

        try {
            $this->writer->update($this->erpOrderTotalsTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idErpOrderTotals = 1;

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals);

        $this->writer->delete($idErpOrderTotals);
    }

    /**
     * @return void
     */
    public function testDeleteNotSuccessful(): void
    {
        $idErpOrderTotals = 1;

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals)
            ->willThrowException(new Exception());

        try {
            $this->writer->delete($idErpOrderTotals);
            static::fail();
        } catch (Exception $exception) {
        }
    }
}
