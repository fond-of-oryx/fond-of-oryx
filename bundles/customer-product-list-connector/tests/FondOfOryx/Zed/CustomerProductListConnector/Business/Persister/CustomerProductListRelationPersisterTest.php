<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface;
use FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CustomerProductListRelationPersisterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationPostPersistPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersister
     */
    protected $customerProductListRelationPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerProductListConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationPostPersistPluginMock = $this->getMockBuilder(
            CustomerProductListRelationPostPersistPluginInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationPersister = new class (
            $this->productListReaderMock,
            $this->entityManagerMock,
            $this->loggerMock,
            $this->transactionHandlerMock,
            [
                $this->customerProductListRelationPostPersistPluginMock,
            ],
        ) extends CustomerProductListRelationPersister {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
             * @param \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface $entityManager
             * @param \Psr\Log\LoggerInterface $logger
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             * @param array<\FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface> $customerProductListRelationPostPersistPlugins
             */
            public function __construct(
                ProductListReaderInterface $productListReader,
                CustomerProductListConnectorEntityManagerInterface $entityManager,
                LoggerInterface $logger,
                TransactionHandlerInterface $transactionHandler,
                array $customerProductListRelationPostPersistPlugins = []
            ) {
                parent::__construct(
                    $productListReader,
                    $entityManager,
                    $logger,
                    $customerProductListRelationPostPersistPlugins,
                );

                $this->transactionHandler = $transactionHandler;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler(): TransactionHandlerInterface
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $idCustomer = 1;
        $newProductListIds = [1, 3, 5];
        $currentProductListIds = [3, 4, 5];

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($newProductListIds);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdCustomer')
            ->with($idCustomer)
            ->willReturn($currentProductListIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignProductListsToCustomer')
            ->with(
                static::callback(
                    static function (array $productListIdsToAssign) {
                        return count($productListIdsToAssign) === 1
                            && array_values($productListIdsToAssign)[0] === 1;
                    },
                ),
                $idCustomer,
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deAssignProductListsFromCustomer')
            ->with(
                static::callback(
                    static function (array $productListIdsToDeAssign) {
                        return count($productListIdsToDeAssign) === 1
                            && array_values($productListIdsToDeAssign)[0] === 4;
                    },
                ),
                $idCustomer,
            );

        $this->customerProductListRelationPostPersistPluginMock->expects(static::atLeastOnce())
            ->method('postPersist')
            ->with($this->customerProductListRelationTransferMock)
            ->willReturn($this->customerProductListRelationTransferMock);

         $this->customerProductListRelationPersister->persist($this->customerProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistWithInvalidCustomerProductListRelationTransfer(): void
    {
        $idCustomer = null;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerProductListRelationTransferMock->expects(static::never())
            ->method('getProductListIds');

        $this->productListReaderMock->expects(static::never())
            ->method('getIdsByIdCustomer');

        $this->entityManagerMock->expects(static::never())
            ->method('assignProductListsToCustomer');

        $this->entityManagerMock->expects(static::never())
            ->method('deAssignProductListsFromCustomer');

        $this->customerProductListRelationPostPersistPluginMock->expects(static::never())
            ->method('postPersist');

        $this->customerProductListRelationPersister->persist($this->customerProductListRelationTransferMock);
    }
}
