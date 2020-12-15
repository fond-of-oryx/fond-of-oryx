<?php

namespace FondOfOryx\Client\CustomerStatistic\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticZedStubTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Zed\CustomerStatisticZedStub
     */
    protected $customerStatisticZedStub;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();
        $this->zedRequestClientMock = $this->getMockBuilder(CustomerStatisticToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransferMock = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticZedStub = new CustomerStatisticZedStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testIncrementLoginCount(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(CustomerStatisticZedStub::URL_INCREMENT_LOGIN_COUNT, $this->customerTransferMock)
            ->willReturn($this->customerStatisticResponseTransferMock);

        static::assertEquals(
            $this->customerStatisticResponseTransferMock,
            $this->customerStatisticZedStub->incrementLoginCount($this->customerTransferMock)
        );
    }
}
