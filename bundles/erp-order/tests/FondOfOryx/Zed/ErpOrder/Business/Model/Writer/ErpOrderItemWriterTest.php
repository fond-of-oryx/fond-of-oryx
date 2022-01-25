<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpOrderItemWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderItemPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemTransfer = $this->getMockBuilder(ErpOrderItemTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpOrderItemWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface $erpOrderPluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpOrderEntityManagerInterface $entityManager,
                ErpOrderItemPluginExecutorInterface $erpOrderPluginExecutor
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
        $this->entityManagerMock->expects($this->once())->method('createErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $result = $this->writer->create($this->erpOrderItemTransfer);

        $this->assertInstanceOf(ErpOrderItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpOrderItemTransfer);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireIdErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireFkErpOrder')->willReturn($this->erpOrderItemTransfer);

        $result = $this->writer->update($this->erpOrderItemTransfer);

        $this->assertInstanceOf(ErpOrderItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->erpOrderItemTransfer->expects($this->once())->method('requireIdErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireFkErpOrder')->willReturn($this->erpOrderItemTransfer);
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpOrderItemTransfer);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpOrderItemByIdErpOrderItem');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpOrderItemByIdErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $catch = null;
        try {
            $this->writer->delete(1);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }
}
