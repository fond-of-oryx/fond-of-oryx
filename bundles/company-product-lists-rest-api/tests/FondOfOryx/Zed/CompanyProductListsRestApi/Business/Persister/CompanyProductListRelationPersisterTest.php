<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class CompanyProductListRelationPersisterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deassignableCompanyIdsFilterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $assignableCompanyIdsFilterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Log\LoggerInterface
     */
    protected $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersister
     */
    protected $companyProductListRelationPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyReaderMock = $this->getMockBuilder(CompanyReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deassignableCompanyIdsFilterMock = $this->getMockBuilder(CompanyIdsFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assignableCompanyIdsFilterMock = $this->getMockBuilder(CompanyIdsFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyProductListsRestApiEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationPersister = new class (
            $this->deassignableCompanyIdsFilterMock,
            $this->assignableCompanyIdsFilterMock,
            $this->companyReaderMock,
            $this->entityManagerMock,
            $this->loggerMock,
            $this->transactionHandlerMock,
        ) extends CompanyProductListRelationPersister {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface $deassignableCompanyIdsFilter
             * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface $assignableCompanyIdsFilter
             * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface $companyReader
             * @param \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface $entityManager
             * @param \Psr\Log\LoggerInterface $logger
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                CompanyIdsFilterInterface $deassignableCompanyIdsFilter,
                CompanyIdsFilterInterface $assignableCompanyIdsFilter,
                CompanyReaderInterface $companyReader,
                CompanyProductListsRestApiEntityManagerInterface $entityManager,
                LoggerInterface $logger,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
                    $deassignableCompanyIdsFilter,
                    $assignableCompanyIdsFilter,
                    $companyReader,
                    $entityManager,
                    $logger,
                );

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
    public function testPersist(): void
    {
        $idProductList = 1;
        $assignedCompanyIds = [1, 2, 3];
        $assignableCompanyIds = [4];
        $deassignableCompanyIds = [2];

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($idProductList);

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdProductList')
            ->with($idProductList)
            ->willReturn($assignedCompanyIds);

        $this->assignableCompanyIdsFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($assignedCompanyIds, $this->restProductListUpdateRequestTransferMock)
            ->willReturn($assignableCompanyIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignCompaniesToProductList')
            ->with($assignableCompanyIds, $idProductList);

        $this->deassignableCompanyIdsFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($assignedCompanyIds, $this->restProductListUpdateRequestTransferMock)
            ->willReturn($deassignableCompanyIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deassignCompaniesFromProductList')
            ->with($deassignableCompanyIds, $idProductList);

        $this->companyProductListRelationPersister->persist(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistWithException(): void
    {
        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willThrowException(new Exception());

        $this->loggerMock->expects(static::atLeastOnce())
            ->method('error')
            ->with('Could not persist company product list relation.');

        $this->productListTransferMock->expects(static::never())
            ->method('getIdProductList');

        $this->companyReaderMock->expects(static::never())
            ->method('getIdsByIdProductList');

        $this->assignableCompanyIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('assignCompaniesToProductList');

        $this->deassignableCompanyIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('deassignCompaniesFromProductList');

        try {
            $this->companyProductListRelationPersister->persist(
                $this->restProductListUpdateRequestTransferMock,
                $this->productListTransferMock,
            );

            static::fail();
        } catch (Throwable $exception) {
        }
    }

    /**
     * @return void
     */
    public function testPersistWithoutIdProductList(): void
    {
        $idProductList = null;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(
                static function ($callable) {
                    $callable();
                },
            );

        $this->loggerMock->expects(static::never())
            ->method('error');

        $this->productListTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($idProductList);

        $this->companyReaderMock->expects(static::never())
            ->method('getIdsByIdProductList');

        $this->assignableCompanyIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('assignCompaniesToProductList');

        $this->deassignableCompanyIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('deassignCompaniesFromProductList');

        $this->companyProductListRelationPersister->persist(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListTransferMock,
        );
    }
}
