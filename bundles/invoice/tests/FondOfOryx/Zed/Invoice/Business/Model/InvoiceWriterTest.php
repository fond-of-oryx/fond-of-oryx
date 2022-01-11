<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager;
use FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface;
use Generated\Shared\Transfer\InvoiceTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class InvoiceWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutor
     */
    protected $invoicePluginExecutorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\InvoiceTransfer
     */
    protected $invoiceTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriterInterface
     */
    protected $invoiceWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(InvoiceEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoicePluginExecutorMock = $this->getMockBuilder(InvoicePluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceTransferMock = $this->getMockBuilder(InvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(PropelDatabaseTransactionHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->invoiceWriter = new class (
            $this->transactionHandlerMock,
            $this->entityManagerMock,
            $this->invoicePluginExecutorMock
        ) extends InvoiceWriter
        {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            private $transactionHandler;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             * @param \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutorInterface $invoicePluginExecutor
             */
            public function __construct(
                TransactionHandlerInterface $transactionHandler,
                InvoiceEntityManagerInterface $entityManager,
                InvoicePluginExecutorInterface $invoicePluginExecutor
            ) {
                parent::__construct($entityManager, $invoicePluginExecutor);

                $this->transactionHandler = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler()
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturn($this->invoiceTransferMock);

        static::assertEquals(true, $this->invoiceWriter->create($this->invoiceTransferMock)->getIsSuccess());
    }
}
