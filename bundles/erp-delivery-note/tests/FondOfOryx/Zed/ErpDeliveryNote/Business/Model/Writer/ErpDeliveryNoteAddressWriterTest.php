<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManager;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpDeliveryNoteAddressWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteAddressTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpDeliveryNoteAddressPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteAddressTransfer = $this->getMockBuilder(ErpDeliveryNoteAddressTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock) extends ErpDeliveryNoteAddressWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             *  constructor.
             *
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface $erpDeliveryNotePluginExecutor
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpDeliveryNoteEntityManagerInterface $entityManager,
                ErpDeliveryNoteAddressPluginExecutorInterface $erpDeliveryNotePluginExecutor
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
        $this->entityManagerMock->expects($this->once())->method('createErpDeliveryNoteAddress')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);

        $result = $this->writer->create($this->erpDeliveryNoteAddressTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteAddressTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpDeliveryNoteAddress')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpDeliveryNoteAddressTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('updateErpDeliveryNoteAddress')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);

        $result = $this->writer->update($this->erpDeliveryNoteAddressTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteAddressTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpDeliveryNoteAddress')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteAddressTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpDeliveryNoteAddressTransfer);
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
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteAddressByIdErpDeliveryNoteAddress');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteAddressByIdErpDeliveryNoteAddress')->will($this->returnCallback(static function () {
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
