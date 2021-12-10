<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CustomerProductListConnectorGuiToCustomerProductListConnectorFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistCustomerProductListRelation(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCustomerProductListRelation')
            ->with($this->customerProductListRelationTransferMock);

        $this->facadeBridge->persistCustomerProductListRelation(
            $this->customerProductListRelationTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testGetAssignedProductListIdsByIdCustomer(): void
    {
        $idCustomer = 1;
        $productListIds = [1, 2, 3, 4];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getAssignedProductListIdsByIdCustomer')
            ->with($idCustomer)
            ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->facadeBridge->getAssignedProductListIdsByIdCustomer(
                $idCustomer,
            ),
        );
    }
}
