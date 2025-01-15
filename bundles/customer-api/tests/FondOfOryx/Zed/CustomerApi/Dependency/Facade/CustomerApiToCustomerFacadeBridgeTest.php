<?php

namespace FondOfOryx\Zed\CustomerApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Customer\Business\CustomerFacade;

class CustomerApiToCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeBridge
     */
    protected CustomerApiToCustomerFacadeBridge $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Customer\Business\CustomerFacade
     */
    protected MockObject|CustomerFacade $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerResponseTransfer|MockObject $customerResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CustomerApiToCustomerFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testFindCustomerById(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->bridge->findCustomerById($this->customerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testAddCustomer(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerResponseTransferMock);

        static::assertEquals(
            $this->customerResponseTransferMock,
            $this->bridge->addCustomer($this->customerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCustomer(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerResponseTransferMock);

        static::assertEquals(
            $this->customerResponseTransferMock,
            $this->bridge->updateCustomer($this->customerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteCustomer(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('deleteCustomer')
            ->with($this->customerTransferMock)
            ->willReturn(true);

        static::assertTrue($this->bridge->deleteCustomer($this->customerTransferMock));
    }
}
