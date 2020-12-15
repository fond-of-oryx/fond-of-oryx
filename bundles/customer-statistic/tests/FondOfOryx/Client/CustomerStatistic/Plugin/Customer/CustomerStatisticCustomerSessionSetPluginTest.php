<?php

namespace FondOfOryx\Client\CustomerStatistic\Plugin\Customer;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerStatistic\CustomerStatisticFactory;
use FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStubInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticCustomerSessionSetPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerStatistic\CustomerStatisticFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticFactoryMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticZedStubMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Plugin\Customer\CustomerStatisticCustomerSessionSetPlugin
     */
    protected $customerStatisticCustomerSessionSetPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerStatisticFactoryMock = $this->getMockBuilder(CustomerStatisticFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticZedStubMock = $this->getMockBuilder(CustomerStatisticZedStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransferMock = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticCustomerSessionSetPlugin = new CustomerStatisticCustomerSessionSetPlugin();
        $this->customerStatisticCustomerSessionSetPlugin->setFactory($this->customerStatisticFactoryMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->customerStatisticFactoryMock->expects(static::atLeastOnce())
            ->method('createCustomerStatisticZedStub')
            ->willReturn($this->customerStatisticZedStubMock);

        $this->customerStatisticZedStubMock->expects(static::atLeastOnce())
            ->method('incrementLoginCount')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerStatisticResponseTransferMock);

        $this->customerStatisticCustomerSessionSetPlugin->execute($this->customerTransferMock);
    }
}
