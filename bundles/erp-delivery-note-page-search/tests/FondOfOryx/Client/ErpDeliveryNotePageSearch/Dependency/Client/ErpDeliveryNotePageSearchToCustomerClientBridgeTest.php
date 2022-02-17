<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\Customer\CustomerClientInterface;

class ErpDeliveryNotePageSearchToCustomerClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientInterface
     */
    protected $erpDeliveryNotePageSearchToCustomerClientBridge;

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

        $this->erpDeliveryNotePageSearchToCustomerClientBridge = new ErpDeliveryNotePageSearchToCustomerClientBridge(
            $this->customerClientMock,
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

        static::assertEquals(
            $this->customerTransferMock,
            $this->erpDeliveryNotePageSearchToCustomerClientBridge->getCustomer(),
        );
    }
}
