<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpOrderTotalWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpOrderTotalTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderTotalPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalTransfer = $this->getMockBuilder(ErpOrderTotalTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpOrderTotalWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalPluginExecutorInterface $erpOrderPluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpOrderEntityManagerInterface $entityManager,
                ErpOrderTotalPluginExecutorInterface $erpOrderPluginExecutor
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
        $this->entityManagerMock->expects($this->once())->method('createErpOrderTotal')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderTotalTransfer);

        $result = $this->writer->create($this->erpOrderTotalTransfer);

        $this->assertInstanceOf(ErpOrderTotalTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpOrderTotal')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderTotalTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpOrderTotalTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderTotal')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderTotalTransfer);

        $result = $this->writer->update($this->erpOrderTotalTransfer);

        $this->assertInstanceOf(ErpOrderTotalTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderTotal')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderTotalTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderTotalTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpOrderTotalTransfer);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }
}
