<?php

namespace FondOfOryx\Zed\CustomerStatistic\Communication\Plugin\Customer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticCustomerTransferExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Communication\Plugin\Customer\CustomerStatisticCustomerTransferExpanderPlugin
     */
    protected $customerStatisticCustomerTransferExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticFacadeMock = $this->getMockBuilder(CustomerStatisticFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticCustomerTransferExpanderPlugin = new CustomerStatisticCustomerTransferExpanderPlugin();
        $this->customerStatisticCustomerTransferExpanderPlugin->setFacade($this->customerStatisticFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpandTransfer(): void
    {
        $this->customerStatisticFacadeMock->expects(static::once())
            ->method('expandCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        $customerTransfer = $this->customerStatisticCustomerTransferExpanderPlugin
            ->expandTransfer($this->customerTransferMock);

        static::assertEquals($this->customerTransferMock, $customerTransfer);
    }
}
