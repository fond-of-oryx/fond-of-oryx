<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManager;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepository;
use FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class ErpInvoiceWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriterInterface
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

        $this->repositoryMock = $this->getMockBuilder(ErpInvoiceRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpInvoicePluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransfer = $this->getMockBuilder(ErpInvoiceTransfer::class)
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

        $this->writer = new class ($this->transactionHandlerFactoryMock, $this->entityManagerMock, $this->pluginExecutorMock, $this->repositoryMock) extends ErpInvoiceWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $thFactory;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface $erpInvoicePluginExecutor
             * @param \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface $repository
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                ErpInvoiceEntityManagerInterface $entityManager,
                ErpInvoicePluginExecutorInterface $erpInvoicePluginExecutor,
                ErpInvoiceRepositoryInterface $repository
            ) {
                $this->thFactory = $transactionHandlerFactory;
                parent::__construct($entityManager, $repository, $erpInvoicePluginExecutor);
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
        $this->entityManagerMock->expects($this->once())->method('createErpInvoice')->willReturn($this->erpInvoiceTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceTransfer);
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceByExternalReference')->willReturn(null);
        $this->erpInvoiceTransfer->expects($this->once())->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->create($this->erpInvoiceTransfer);

        $this->assertInstanceOf(ErpInvoiceResponseTransfer::class, $result);
        $this->assertInstanceOf(ErpInvoiceTransfer::class, $result->getErpInvoice());
        $this->assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testCreateNotSuccessful(): void
    {
        $this->entityManagerMock->expects($this->never())->method('createErpInvoice');
        $this->pluginExecutorMock->expects($this->never())->method('executePreSavePlugins');
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins');
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceByExternalReference')->willReturn($this->erpInvoiceTransfer);
        $this->erpInvoiceTransfer->expects($this->exactly(2))->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->create($this->erpInvoiceTransfer);

        $this->assertInstanceOf(ErpInvoiceResponseTransfer::class, $result);
        $this->assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpInvoice')->willReturn($this->erpInvoiceTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpInvoiceTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpInvoiceTransfer);
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceByExternalReference')->willReturn($this->erpInvoiceTransfer);
        $this->erpInvoiceTransfer->expects($this->once())->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->update($this->erpInvoiceTransfer);

        $this->assertInstanceOf(ErpInvoiceResponseTransfer::class, $result);
        $this->assertInstanceOf(ErpInvoiceTransfer::class, $result->getErpInvoice());
        $this->assertTrue($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccessful(): void
    {
        $this->entityManagerMock->expects($this->never())->method('updateErpInvoice');
        $this->pluginExecutorMock->expects($this->never())->method('executePreSavePlugins');
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins');
        $this->repositoryMock->expects($this->once())->method('findErpInvoiceByExternalReference')->willReturn(null);
        $this->erpInvoiceTransfer->expects($this->exactly(2))->method('getExternalReference')->willReturn('external ref');

        $result = $this->writer->update($this->erpInvoiceTransfer);

        $this->assertInstanceOf(ErpInvoiceResponseTransfer::class, $result);
        $this->assertFalse($result->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceByIdErpInvoice');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpInvoiceByIdErpInvoice')->will($this->returnCallback(static function () {
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
