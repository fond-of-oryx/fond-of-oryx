<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;

class CustomerProductListConnectorGuiToCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Facade\CustomerProductListConnectorGuiToCustomerFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CustomerProductListConnectorGuiToCustomerFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testGetCustomerById(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->facadeBridge->findCustomerById($this->customerTransferMock),
        );
    }
}
