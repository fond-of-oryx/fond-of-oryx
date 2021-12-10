<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

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

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationPersister = new CustomerProductListRelationPersister(
            $this->productListReaderMock,
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $idCustomer = 1;
        $newProductListIds = [1, 3, 5];
        $currentProductListIds = [3, 4, 5];

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

         $this->customerProductListRelationPersister->persist($this->customerProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistWithInvalidCustomerProductListRelationTransfer(): void
    {
        $idCustomer = null;

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

        $this->customerProductListRelationPersister->persist($this->customerProductListRelationTransferMock);
    }
}
