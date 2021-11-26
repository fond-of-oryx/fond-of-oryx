<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManager;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpInvoiceExpenseWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceExpenseTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceExpenseWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpInvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpInvoiceExpensePluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseTransfer = $this->getMockBuilder(ErpInvoiceExpenseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerFactoryMock = $this->getMockBuilder(TransactionHandlerFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handlerMock = $this->getMockBuilder(PropelDatabaseTransactionHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handlerMock->expects($this->atLeastOnce())->method('handleTransaction')->will($this->returnCallback(static function (
            $closure
        ) {
            $result = $closure();
            if (empty($result)) {
                return;
            }

            return $result;
        }));

        $this->transactionHandlerFactoryMock->method('createHandler')->willReturn($this->handlerMock);

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpInvoiceExpenseWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceExpensePluginExecutorInterface $erpInvoicePluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpInvoiceEntityManagerInterface $entityManager,
                ErpInvoiceExpensePluginExecutorInterface $erpInvoicePluginExecutor
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $erpInvoicePluginExecutor);
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
        $this->entityManagerMock->expects($this->once())->method('createErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);

        $result = $this->writer->create($this->erpInvoiceExpenseTransfer);

        $this->assertInstanceOf(ErpInvoiceExpenseTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpInvoiceExpense')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpInvoiceExpenseTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('updateErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->erpInvoiceExpenseTransfer->expects($this->once())->method('requireIdErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->erpInvoiceExpenseTransfer->expects($this->once())->method('requireFkErpInvoice')->willReturn($this->erpInvoiceExpenseTransfer);

        $result = $this->writer->update($this->erpInvoiceExpenseTransfer);

        $this->assertInstanceOf(ErpInvoiceExpenseTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->erpInvoiceExpenseTransfer->expects($this->once())->method('requireIdErpInvoiceExpense')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->erpInvoiceExpenseTransfer->expects($this->once())->method('requireFkErpInvoice')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->entityManagerMock->expects($this->once())->method('updateErpInvoiceExpense')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpInvoiceExpenseTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpInvoiceExpenseTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceExpenseByIdErpInvoiceExpense');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceExpenseByIdErpInvoiceExpense')->will($this->returnCallback(static function () {
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
