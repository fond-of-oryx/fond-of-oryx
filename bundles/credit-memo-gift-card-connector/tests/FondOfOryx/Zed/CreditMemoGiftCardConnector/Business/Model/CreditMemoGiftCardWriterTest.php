<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriter;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class CreditMemoGiftCardWriterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CreditMemoGiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoGiftCardTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityManagerMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerFactoryMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $handlerMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardWriter
     */
    protected $model;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoGiftCardTransferMock = $this
            ->getMockBuilder(CreditMemoGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this
            ->getMockBuilder(CreditMemoGiftCardConnectorEntityManager::class)
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

        $this->model = new class (
            $this->transactionHandlerFactoryMock,
            $this->entityManagerMock
        ) extends CreditMemoGiftCardWriter {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            protected $transactionHandlerFactory;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface $transactionHandlerFactory
             * @param \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManager $entityManager
             */
            public function __construct(
                TransactionHandlerFactoryInterface $transactionHandlerFactory,
                CreditMemoGiftCardConnectorEntityManagerInterface $entityManager
            ) {
                $this->transactionHandlerFactory = $transactionHandlerFactory;

                parent::__construct($entityManager);
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerFactoryInterface
             */
            public function createTransactionHandlerFactory()
            {
                return $this->transactionHandlerFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createCreditMemoGiftCard')
            ->with($this->creditMemoGiftCardTransferMock)
            ->willReturn($this->creditMemoGiftCardTransferMock);

        static::assertInstanceOf(
            CreditMemoGiftCardTransfer::class,
            $this->model->create($this->creditMemoGiftCardTransferMock),
        );
    }
}
