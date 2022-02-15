<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManager;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepository;
use FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpDeliveryNoteWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriterInterface
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

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNoteRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpDeliveryNotePluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransfer = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock, $this->repositoryMock) extends ErpDeliveryNoteWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface $erpDeliveryNotePluginExecutor
             * @param \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface $repository
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpDeliveryNoteEntityManagerInterface $entityManager,
                ErpDeliveryNotePluginExecutorInterface $erpDeliveryNotePluginExecutor,
                ErpDeliveryNoteRepositoryInterface $repository
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $repository, $erpDeliveryNotePluginExecutor);
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
        $this->entityManagerMock->expects($this->once())->method('createErpDeliveryNote')->willReturn($this->erpDeliveryNoteTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteTransfer);
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteByExternalReference')->willReturn(null);
        $this->erpDeliveryNoteTransfer->expects($this->once())->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->create($this->erpDeliveryNoteTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteResponseTransfer::class, $result);
        $this->assertInstanceOf(ErpDeliveryNoteTransfer::class, $result->getErpDeliveryNote());
        $this->assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testCreateNotSuccessful(): void
    {
        $this->entityManagerMock->expects($this->never())->method('createErpDeliveryNote');
        $this->pluginExecutorMock->expects($this->never())->method('executePreSavePlugins');
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins');
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteByExternalReference')->willReturn($this->erpDeliveryNoteTransfer);
        $this->erpDeliveryNoteTransfer->expects($this->exactly(2))->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->create($this->erpDeliveryNoteTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteResponseTransfer::class, $result);
        $this->assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpDeliveryNote')->willReturn($this->erpDeliveryNoteTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpDeliveryNoteTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpDeliveryNoteTransfer);
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteByExternalReference')->willReturn($this->erpDeliveryNoteTransfer);
        $this->erpDeliveryNoteTransfer->expects($this->once())->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->update($this->erpDeliveryNoteTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteResponseTransfer::class, $result);
        $this->assertInstanceOf(ErpDeliveryNoteTransfer::class, $result->getErpDeliveryNote());
        $this->assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccessful(): void
    {
        $this->entityManagerMock->expects($this->never())->method('updateErpDeliveryNote');
        $this->pluginExecutorMock->expects($this->never())->method('executePreSavePlugins');
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins');
        $this->repositoryMock->expects($this->once())->method('findErpDeliveryNoteByExternalReference')->willReturn(null);
        $this->erpDeliveryNoteTransfer->expects($this->exactly(2))->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->update($this->erpDeliveryNoteTransfer);

        $this->assertInstanceOf(ErpDeliveryNoteResponseTransfer::class, $result);
        $this->assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteByIdErpDeliveryNote');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpDeliveryNoteByIdErpDeliveryNote')->will($this->returnCallback(static function () {
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
