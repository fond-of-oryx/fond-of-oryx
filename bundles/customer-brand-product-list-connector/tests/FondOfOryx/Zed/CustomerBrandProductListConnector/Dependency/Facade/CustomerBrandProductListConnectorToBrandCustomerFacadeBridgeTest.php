<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeBridge;
use FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;

class CustomerBrandProductListConnectorToBrandCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandCustomer\Business\BrandCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCustomerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerBrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerBrandRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(BrandCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandRelationTransferMock = $this->getMockBuilder(CustomerBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CustomerBrandProductListConnectorToBrandCustomerFacadeBridge($this->brandCustomerFacadeMock);
    }

    /**
     * @return void
     */
    public function testSaveCustomerBrandRelation(): void
    {
        $this->brandCustomerFacadeMock->expects(static::atLeastOnce())
            ->method('saveCustomerBrandRelation')
            ->with($this->customerBrandRelationTransferMock)
            ->willReturn($this->customerBrandRelationTransferMock);

        static::assertEquals(
            $this->customerBrandRelationTransferMock,
            $this->bridge->saveCustomerBrandRelation($this->customerBrandRelationTransferMock),
        );
    }
}
