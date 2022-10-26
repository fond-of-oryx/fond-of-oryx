<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class CustomerProductListRelationPersisterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerReaderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deassignableCustomerIdsFilterMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $assignableCustomerIdsFilterMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersister
     */
    protected $customerProductListRelationPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerReaderMock = $this->getMockBuilder(CustomerReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deassignableCustomerIdsFilterMock = $this->getMockBuilder(CustomerIdsFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assignableCustomerIdsFilterMock = $this->getMockBuilder(CustomerIdsFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerProductListsRestApiEntityManagerInterface::class)
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

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationPersister = new class (
            $this->customerReaderMock,
            $this->deassignableCustomerIdsFilterMock,
            $this->assignableCustomerIdsFilterMock,
            $this->entityManagerMock,
            $this->loggerMock,
            $this->transactionHandlerMock,
        ) extends CustomerProductListRelationPersister {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandler;

            /**
             * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface $customerReader
             * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface $deassignableCustomerIdsFilter
             * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface $assignableCustomerIdsFilter
             * @param \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface $entityManager
             * @param \Psr\Log\LoggerInterface $logger
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             */
            public function __construct(
                CustomerReaderInterface $customerReader,
                CustomerIdsFilterInterface $deassignableCustomerIdsFilter,
                CustomerIdsFilterInterface $assignableCustomerIdsFilter,
                CustomerProductListsRestApiEntityManagerInterface $entityManager,
                LoggerInterface $logger,
                TransactionHandlerInterface $transactionHandler
            ) {
                parent::__construct(
                    $customerReader,
                    $deassignableCustomerIdsFilter,
                    $assignableCustomerIdsFilter,
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
        $assignedCustomerIds = [1, 2, 3];
        $assignableCustomerIds = [4];
        $deassignableCustomerIds = [2];

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

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdProductList')
            ->with($idProductList)
            ->willReturn($assignedCustomerIds);

        $this->assignableCustomerIdsFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($assignedCustomerIds, $this->restProductListsAttributesTransferMock)
            ->willReturn($assignableCustomerIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignCustomersToProductList')
            ->with($assignableCustomerIds, $idProductList);

        $this->deassignableCustomerIdsFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($assignedCustomerIds, $this->restProductListsAttributesTransferMock)
            ->willReturn($deassignableCustomerIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deassignCustomersFromProductList')
            ->with($deassignableCustomerIds, $idProductList);

        $this->customerProductListRelationPersister->persist(
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
            ->with('Could not persist customer product list relation.');

        $this->productListTransferMock->expects(static::never())
            ->method('getIdProductList');

        $this->restProductListUpdateRequestTransferMock->expects(static::never())
            ->method('getProductList');

        $this->customerReaderMock->expects(static::never())
            ->method('getIdsByIdProductList');

        $this->assignableCustomerIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('assignCustomersToProductList');

        $this->deassignableCustomerIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('deassignCustomersFromProductList');

        try {
            $this->customerProductListRelationPersister->persist(
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

        $this->restProductListUpdateRequestTransferMock->expects(static::atLeastOnce())
            ->method('getProductList')
            ->willReturn($this->restProductListsAttributesTransferMock);

        $this->customerReaderMock->expects(static::never())
            ->method('getIdsByIdProductList');

        $this->assignableCustomerIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('assignCustomersToProductList');

        $this->deassignableCustomerIdsFilterMock->expects(static::never())
            ->method('filter');

        $this->entityManagerMock->expects(static::never())
            ->method('deassignCustomersFromProductList');

        $this->customerProductListRelationPersister->persist(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListTransferMock,
        );
    }
}
