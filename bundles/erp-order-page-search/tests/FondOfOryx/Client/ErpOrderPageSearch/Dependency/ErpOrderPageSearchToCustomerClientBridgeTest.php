<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class ErpOrderPageSearchToCustomerClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface
     */
    protected $erpOrderPageSearchToCustomerClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Customer\CustomerClientInterface
     */
    protected $customerClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerClientMock = $this->getMockBuilder(CustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCustomerClientBridge = new ErpOrderPageSearchToCustomerClientBridge(
            $this->customerClientMock
        );
    }

    /**
     * @return void
     */
    public function testGetCustomer(): void
    {
        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->assertInstanceOf(
            CustomerTransfer::class,
            $this->erpOrderPageSearchToCustomerClientBridge->getCustomer()
        );
    }
}
