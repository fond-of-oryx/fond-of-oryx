<?php

namespace FondOfOryx\Client\CustomerStatistic\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CustomerStatisticToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var \FondOfOryx\Client\CustomerStatistic\Dependency\Client\CustomerStatisticToZedRequestClientBridge
     */
    protected $customerStatisticToZedRequestClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticToZedRequestClientBridge = new CustomerStatisticToZedRequestClientBridge(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $url = 'foo';

        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with($url, $this->transferMock, null)
            ->willReturn($this->transferMock);

        static::assertEquals(
            $this->transferMock,
            $this->customerStatisticToZedRequestClientBridge->call($url, $this->transferMock, null),
        );
    }
}
