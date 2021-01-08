<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticReaderMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpander
     */
    protected $customerExpander;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerStatisticReaderMock = $this->getMockBuilder(CustomerStatisticReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticTransferMock = $this->getMockBuilder(CustomerStatisticTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpander = new CustomerExpander($this->customerStatisticReaderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCustomer = 1;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerStatisticReaderMock->expects(static::atLeastOnce())
            ->method('getByIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->customerStatisticTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerStatistic')
            ->with($this->customerStatisticTransferMock)
            ->willReturn($this->customerTransferMock);

        self::assertEquals(
            $this->customerTransferMock,
            $this->customerExpander->expand($this->customerTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithEmptyCustomerTransfer(): void
    {
        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->customerStatisticReaderMock->expects(static::never())
            ->method('getByIdCustomer');

        $this->customerTransferMock->expects(static::never())
            ->method('setCustomerStatistic');

        self::assertEquals(
            $this->customerTransferMock,
            $this->customerExpander->expand($this->customerTransferMock)
        );
    }
}
