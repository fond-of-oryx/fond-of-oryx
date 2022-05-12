<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderTransfer;
use SprykerEco\Service\Payone\PayoneServiceInterface;

class JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneServiceInterface
     */
    protected $payoneService;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $payoneServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->payoneServiceMock = $this
            ->getMockBuilder(PayoneServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this
            ->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->payoneService = new JellyfishSalesOrderPayoneGiftCardConnectorToPayoneService(
            $this->payoneServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testDistributeOrderPrice(): void
    {
        $this->payoneServiceMock->expects(static::atLeastOnce())
            ->method('distributeOrderPrice')
            ->willReturn($this->orderTransferMock);

        static::assertInstanceOf(
            OrderTransfer::class,
            $this->payoneService->distributeOrderPrice($this->orderTransferMock),
        );
    }
}
