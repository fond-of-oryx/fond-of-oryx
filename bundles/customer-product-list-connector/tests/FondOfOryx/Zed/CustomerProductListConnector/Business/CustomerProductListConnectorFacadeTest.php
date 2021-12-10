<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerProductListPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListReaderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CustomerProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListPersisterMock = $this->getMockBuilder(CustomerProductListRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListReaderMock = $this->getMockBuilder(ProductListReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerProductListConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCustomerProductListRelation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerProductListRelationPersister')
            ->willReturn($this->customerProductListPersisterMock);

        $this->customerProductListPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->customerProductListRelationTransferMock);

        $this->facade->persistCustomerProductListRelation($this->customerProductListRelationTransferMock);
    }

    /**
     * @return void
     */
    public function testGetAssignedProductListIdsByIdCustomer(): void
    {
        $idCustomer = 1;
        $productListIds = [1, 2, 3, 4];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductListReader')
            ->willReturn($this->productListReaderMock);

        $this->productListReaderMock->expects(static::atLeastOnce())
            ->method('getIdsByIdCustomer')
            ->with($idCustomer)
            ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->facade->getAssignedProductListIdsByIdCustomer($idCustomer),
        );
    }
}
