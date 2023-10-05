<?php

namespace FondOfOryx\Zed\ErpOrder\Persistence\tests\FondOfOryx\Zed\ErpOrder\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeBridge;
use Generated\Shared\Transfer\CustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class ErpOrderToCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    protected MockObject|CustomerFacadeInterface $customerFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected MockObject|CustomerTransfer $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Dependency\Facade\ErpOrderToCustomerFacadeBridge
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->customerFacadeMock = $this
            ->getMockBuilder(CustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ErpOrderToCustomerFacadeBridge($this->customerFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetCustomer(): void
    {
        $this->customerFacadeMock->expects($this->once())
            ->method('getCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $this->assertEquals(
            $this->customerTransferMock,
            $this->facade->getCustomer($this->customerTransferMock),
        );
    }
}
