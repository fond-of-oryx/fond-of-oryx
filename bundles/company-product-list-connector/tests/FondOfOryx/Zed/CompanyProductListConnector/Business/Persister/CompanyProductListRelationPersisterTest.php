<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface;
use FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyProductListRelationPersisterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationPostPersistPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister
     */
    protected $companyProductListRelationPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationPostPersistPluginMock = $this->getMockBuilder(
            CompanyProductListRelationPostPersistPluginInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationPersister = new class (
            $this->productListReaderMock,
            $this->entityManagerMock,
            $this->loggerMock,
            $this->transactionHandlerMock,
            [
                $this->companyProductListRelationPostPersistPluginMock,
            ],
        ) extends CompanyProductListRelationPersister {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface $productListReader
             * @param \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface $entityManager
             * @param \Psr\Log\LoggerInterface $logger
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             * @param array<\FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface> $companyProductListRelationPostPersistPlugins
             */
            public function __construct(
                ProductListReaderInterface $productListReader,
                CompanyProductListConnectorEntityManagerInterface $entityManager,
                LoggerInterface $logger,
                TransactionHandlerInterface $transactionHandler,
                array $companyProductListRelationPostPersistPlugins = []
            ) {
                parent::__construct(
                    $productListReader,
                    $entityManager,
                    $logger,
                    $companyProductListRelationPostPersistPlugins,
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
        $idCompany = 1;
        $newProductListIds = [1, 3, 5];
        $currentProductListIds = [3, 4, 5];

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIds')
            ->willReturn($newProductListIds);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdCompany')
            ->with($idCompany)
            ->willReturn($currentProductListIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignProductListsToCompany')
            ->with(
                static::callback(
                    static function (array $productListIdsToAssign) {
                        return count($productListIdsToAssign) === 1
                            && array_values($productListIdsToAssign)[0] === 1;
                    },
                ),
                $idCompany,
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deAssignProductListsFromCompany')
            ->with(
                static::callback(
                    static function (array $productListIdsToDeAssign) {
                        return count($productListIdsToDeAssign) === 1
                            && array_values($productListIdsToDeAssign)[0] === 4;
                    },
                ),
                $idCompany,
            );

        $this->companyProductListRelationPostPersistPluginMock->expects(static::atLeastOnce())
            ->method('postPersist')
            ->with($this->companyProductListRelationTransferMock)
            ->willReturn($this->companyProductListRelationTransferMock);

         $this->companyProductListRelationPersister->persist($this->companyProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistWithInvalidCompanyProductListRelationTransfer(): void
    {
        $idCompany = null;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->companyProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->companyProductListRelationTransferMock->expects(static::never())
            ->method('getProductListIds');

        $this->productListReaderMock->expects(static::never())
            ->method('getIdsByIdCompany');

        $this->entityManagerMock->expects(static::never())
            ->method('assignProductListsToCompany');

        $this->entityManagerMock->expects(static::never())
            ->method('deAssignProductListsFromCompany');

        $this->companyProductListRelationPostPersistPluginMock->expects(static::never())
            ->method('postPersist');

        $this->companyProductListRelationPersister->persist($this->companyProductListRelationTransferMock);
    }
}
