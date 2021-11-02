<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface;
use Generated\Shared\Transfer\CustomerStatisticTransfer;

class CustomerStatisticWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriter
     */
    protected $customerStatisticWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CustomerStatisticEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticTransferMock = $this->getMockBuilder(CustomerStatisticTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticWriter = new CustomerStatisticWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('persistCustomerStatistic')
            ->with($this->customerStatisticTransferMock)
            ->willReturn($this->customerStatisticTransferMock);

        $customerStatisticResponseTransfer = $this->customerStatisticWriter
            ->persist($this->customerStatisticTransferMock);

        static::assertTrue($customerStatisticResponseTransfer->getIsSuccessful());

        static::assertEquals(
            $this->customerStatisticTransferMock,
            $customerStatisticResponseTransfer->getCustomerStatistic(),
        );
    }
}
