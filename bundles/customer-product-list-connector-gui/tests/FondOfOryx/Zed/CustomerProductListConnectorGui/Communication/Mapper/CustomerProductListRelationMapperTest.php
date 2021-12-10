<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer;

class CustomerProductListRelationMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerProductListConnectorFormTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListConnectorFormTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Mapper\CustomerProductListRelationMapper
     */
    protected $mapper;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerProductListConnectorFormTransferMock = $this->getMockBuilder(CustomerProductListConnectorFormTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new CustomerProductListRelationMapper();
    }

    /**
     * @return void
     */
    public function testFromCustomerProductListConnectorGui(): void
    {
        $productListIdsToAssigned = [1];
        $productListIdsToDeAssigned = [3];
        $assignedProductListIds = [2, 3, 4];
        $idCustomer = 1;

        $this->customerProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIdsToAssign')
            ->willReturn($productListIdsToAssigned);

        $this->customerProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIdsToDeAssign')
            ->willReturn($productListIdsToDeAssigned);

        $this->customerProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getAssignedProductListIds')
            ->willReturn($assignedProductListIds);

        $this->customerProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $customerProductListRelationTransfer = $this->mapper->fromCustomerProductListConnectorGui(
            $this->customerProductListConnectorFormTransferMock,
        );

        static::assertEquals($idCustomer, $customerProductListRelationTransfer->getIdCustomer());
        static::assertEquals([1, 2, 4], $customerProductListRelationTransfer->getProductListIds());
    }
}
