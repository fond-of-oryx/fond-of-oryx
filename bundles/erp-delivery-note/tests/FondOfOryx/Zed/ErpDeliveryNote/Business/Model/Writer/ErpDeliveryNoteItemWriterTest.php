<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManager;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpDeliveryNoteItemWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpDeliveryNoteEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpDeliveryNoteItemPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteItemTransfer = $this->getMockBuilder(ErpDeliveryNoteItemTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpDeliveryNoteItemWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface $erpDeliveryNotePluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpDeliveryNoteEntityManagerInterface $entityManager,
                ErpDeliveryNoteItemPluginExecutorInterface $erpDeliveryNotePluginExecutor
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $erpDeliveryNotePluginExecutor);
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
        $this->entityManagerMock->expects($this->once())->method('createErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);

        $result = $this->writer->create($this->erpDeliveryNoteItemTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpDeliveryNoteItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpDeliveryNoteItemTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('updateErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->erpDeliveryNoteItemTransfer->expects($this->once())->method('requireIdErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->erpDeliveryNoteItemTransfer->expects($this->once())->method('requireFkErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemTransfer);

        $result = $this->writer->update($this->erpDeliveryNoteItemTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->erpDeliveryNoteItemTransfer->expects($this->once())->method('requireIdErpDeliveryNoteItem')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->erpDeliveryNoteItemTransfer->expects($this->once())->method('requireFkErpDeliveryNote')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->entityManagerMock->expects($this->once())->method('updateErpDeliveryNoteItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteItemTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpDeliveryNoteItemTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteItemByIdErpDeliveryNoteItem');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteItemByIdErpDeliveryNoteItem')->will($this->returnCallback(static function () {
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
