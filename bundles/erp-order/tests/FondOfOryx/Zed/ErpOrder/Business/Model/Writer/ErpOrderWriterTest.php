<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;
use Throwable;

class ErpOrderWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
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

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerFactoryMock->expects(static::atLeastOnce())
            ->method('createHandler')
            ->willReturn($this->handlerMock);

        $this->writer = new class (
            $this->transactionHandlerFactoryMock,
            $this->entityManagerMock,
            $this->pluginExecutorMock,
            $this->loggerMock
        ) extends ErpOrderWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderPluginExecutorInterface $erpOrderPluginExecutor
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpOrderEntityManagerInterface $entityManager,
                ErpOrderPluginExecutorInterface $erpOrderPluginExecutor,
                LoggerInterface $logger
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $erpOrderPluginExecutor, $logger);
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
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $result = $this->writer->create($this->erpOrderTransferMock);

        static::assertEquals($this->erpOrderTransferMock, $result->getErpOrder());
        static::assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testCreateNotSuccessful(): void
    {
        $data = '{}';
        $exception = new Exception('foo');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->willThrowException($exception);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('serialize')
            ->willReturn($data);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error')
            ->with($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $data,
            ]);

        $result = $this->writer->create($this->erpOrderTransferMock);

        static::assertEquals(null, $result->getErpOrder());
        static::assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $result = $this->writer->update($this->erpOrderTransferMock);

        static::assertEquals($this->erpOrderTransferMock, $result->getErpOrder());
        static::assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccessful(): void
    {
        $data = '{}';
        $exception = new Exception('foo');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->willThrowException($exception);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins')
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('serialize')
            ->willReturn($data);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error')
            ->with($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $data,
            ]);

        $result = $this->writer->update($this->erpOrderTransferMock);

        static::assertEquals(null, $result->getErpOrder());
        static::assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderByIdErpOrder');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $idErpOrder = 1;
        $exception = new Exception('foo');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderByIdErpOrder')
            ->willThrowException($exception);

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error')
            ->with($exception->getMessage(), [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $idErpOrder,
            ]);

        try {
            $this->writer->delete($idErpOrder);
            static::fail();
        } catch (Throwable $exception) {
        }
    }
}
