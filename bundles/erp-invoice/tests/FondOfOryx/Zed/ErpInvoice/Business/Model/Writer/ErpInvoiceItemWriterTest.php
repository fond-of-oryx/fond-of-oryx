<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManager;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpInvoiceItemWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpInvoiceItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpInvoiceItemPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemTransfer = $this->getMockBuilder(ErpInvoiceItemTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpInvoiceItemWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface $erpInvoicePluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpInvoiceEntityManagerInterface $entityManager,
                ErpInvoiceItemPluginExecutorInterface $erpInvoicePluginExecutor
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
        $this->entityManagerMock->expects($this->once())->method('createErpInvoiceItem')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceItemTransfer);

        $result = $this->writer->create($this->erpInvoiceItemTransfer);

        $this->assertInstanceOf(ErpInvoiceItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpInvoiceItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpInvoiceItemTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpInvoiceItemTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('updateErpInvoiceItem')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceItemTransfer);
        $this->erpInvoiceItemTransfer->expects($this->once())->method('requireIdErpInvoiceItem')->willReturn($this->erpInvoiceItemTransfer);
        $this->erpInvoiceItemTransfer->expects($this->once())->method('requireFkErpInvoice')->willReturn($this->erpInvoiceItemTransfer);

        $result = $this->writer->update($this->erpInvoiceItemTransfer);

        $this->assertInstanceOf(ErpInvoiceItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->erpInvoiceItemTransfer->expects($this->once())->method('requireIdErpInvoiceItem')->willReturn($this->erpInvoiceItemTransfer);
        $this->erpInvoiceItemTransfer->expects($this->once())->method('requireFkErpInvoice')->willReturn($this->erpInvoiceItemTransfer);
        $this->entityManagerMock->expects($this->once())->method('updateErpInvoiceItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpInvoiceItemTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpInvoiceItemTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceItemByIdErpInvoiceItem');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceItemByIdErpInvoiceItem')->will($this->returnCallback(static function () {
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
