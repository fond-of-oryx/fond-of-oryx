<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManager;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface;
use Generated\Shared\Transfer\CreditMemoErrorTransfer;
use Generated\Shared\Transfer\CreditMemoResponseTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CreditMemoWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginExecutorMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoWriterInterface
     */
    protected $model;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CreditMemoEntityManager::class)->disableOriginalConstructor()->getMock();
        $this->pluginExecutorMock = $this->getMockBuilder(CreditMemoPluginExecutorInterface::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)->disableOriginalConstructor()->getMock();

        $this->model = new class ($this->entityManagerMock, $this->pluginExecutorMock, $this->transactionHandlerMock) extends CreditMemoWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandlerMock;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface $entityManager
             * @param \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface $creditMemoPluginExecutor
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                CreditMemoEntityManagerInterface $entityManager,
                CreditMemoPluginExecutorInterface $creditMemoPluginExecutor,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct($entityManager, $creditMemoPluginExecutor);
                $this->transactionHandlerMock = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler()
            {
                return $this->transactionHandlerMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            $creditMemoTransfer = $callable();
            static::assertInstanceOf(CreditMemoTransfer::class, $creditMemoTransfer);

            return $creditMemoTransfer;
        });
        $this->pluginExecutorMock->expects(static::once())->method('executePreSavePlugins')->willReturn($this->creditMemoTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createCreditMemo')->willReturn($this->creditMemoTransferMock);
        $this->pluginExecutorMock->expects(static::once())->method('executePostSavePlugins')->willReturn($this->creditMemoTransferMock);

        $response = $this->model->create($this->creditMemoTransferMock);

        static::assertInstanceOf(CreditMemoResponseTransfer::class, $response);
        static::assertInstanceOf(CreditMemoTransfer::class, $response->getCreditMemoTransfer());
        static::assertTrue($response->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testCreateWillFailAndThrowsException(): void
    {
        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            throw new Exception('fail');
        });
        $this->entityManagerMock->expects(static::never())->method('createCreditMemo');

        $response = $this->model->create($this->creditMemoTransferMock);

        static::assertInstanceOf(CreditMemoResponseTransfer::class, $response);
        static::assertNull($response->getCreditMemoTransfer());
        static::assertFalse($response->getIsSuccess());
        static::assertCount(1, $response->getErrors());
        static::assertInstanceOf(CreditMemoErrorTransfer::class, $response->getErrors()->offsetGet(0));
        static::assertSame('fail', $response->getErrors()->offsetGet(0)->getMessage());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            $creditMemoTransfer = $callable();
            static::assertInstanceOf(CreditMemoTransfer::class, $creditMemoTransfer);

            return $creditMemoTransfer;
        });
        $this->entityManagerMock->expects(static::never())->method('createCreditMemo');
        $this->entityManagerMock->expects(static::once())->method('updateCreditMemo')->willReturn($this->creditMemoTransferMock);

        $response = $this->model->update($this->creditMemoTransferMock);

        static::assertInstanceOf(CreditMemoResponseTransfer::class, $response);
        static::assertInstanceOf(CreditMemoTransfer::class, $response->getCreditMemoTransfer());
        static::assertTrue($response->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testUpdateWillFailAndThrowsException(): void
    {
        $this->transactionHandlerMock->expects(static::once())->method('handleTransaction')->willReturnCallback(static function ($callable) {
            throw new Exception('fail');
        });
        $this->entityManagerMock->expects(static::never())->method('updateCreditMemo');

        $response = $this->model->update($this->creditMemoTransferMock);

        static::assertInstanceOf(CreditMemoResponseTransfer::class, $response);
        static::assertNull($response->getCreditMemoTransfer());
        static::assertFalse($response->getIsSuccess());
        static::assertCount(1, $response->getErrors());
        static::assertInstanceOf(CreditMemoErrorTransfer::class, $response->getErrors()->offsetGet(0));
        static::assertSame('fail', $response->getErrors()->offsetGet(0)->getMessage());
    }
}
