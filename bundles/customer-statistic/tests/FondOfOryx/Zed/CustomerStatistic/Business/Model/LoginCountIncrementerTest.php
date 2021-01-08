<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class LoginCountIncrementerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticReaderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticWriterMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementer
     */
    protected $loginCountIncrementer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerStatisticReaderMock = $this->getMockBuilder(CustomerStatisticReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticWriterMock = $this->getMockBuilder(CustomerStatisticWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticTransferMock = $this->getMockBuilder(CustomerStatisticTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransferMock = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loginCountIncrementer = new LoginCountIncrementer(
            $this->customerStatisticReaderMock,
            $this->customerStatisticWriterMock
        );
    }

    /**
     * @return void
     */
    public function testIncrementWithEmptyCustomerTransfer(): void
    {
        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->customerStatisticReaderMock->expects(static::never())
            ->method('getByIdCustomer');

        $this->customerStatisticWriterMock->expects(static::never())
            ->method('persist');

        $customerStatisticResponseTransfer = $this->loginCountIncrementer->increment($this->customerTransferMock);

        static::assertEquals(
            null,
            $customerStatisticResponseTransfer->getCustomerStatistic()
        );

        static::assertFalse(
            $customerStatisticResponseTransfer->getIsSuccessful()
        );
    }

    /**
     * @return void
     */
    public function testIncrementWithExistingCustomerStatistic(): void
    {
        $idCustomer = 1;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerStatisticReaderMock->expects(static::atLeastOnce())
            ->method('getByIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->customerStatisticTransferMock);

        $this->customerStatisticWriterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->customerStatisticTransferMock)
            ->willReturn($this->customerStatisticResponseTransferMock);

        $this->customerStatisticTransferMock->expects(static::atLeastOnce())
            ->method('getLoginCount')
            ->willReturn(5);

        $this->customerStatisticTransferMock->expects(static::atLeastOnce())
            ->method('setLoginCount')
            ->with(6)
            ->willReturn($this->customerStatisticTransferMock);

        static::assertEquals(
            $this->customerStatisticResponseTransferMock,
            $this->loginCountIncrementer->increment($this->customerTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testIncrement(): void
    {
        $idCustomer = 1;

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerStatisticReaderMock->expects(static::atLeastOnce())
            ->method('getByIdCustomer')
            ->with($idCustomer)
            ->willReturn(null);

        $this->customerStatisticWriterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with(
                static::callback(
                    static function (CustomerStatisticTransfer $customerStatisticTransfer) use ($idCustomer) {
                        return $customerStatisticTransfer->getFkCustomer() === $idCustomer
                            && $customerStatisticTransfer->getLoginCount() === 1;
                    }
                )
            )->willReturn($this->customerStatisticResponseTransferMock);

        static::assertEquals(
            $this->customerStatisticResponseTransferMock,
            $this->loginCountIncrementer->increment($this->customerTransferMock)
        );
    }
}
