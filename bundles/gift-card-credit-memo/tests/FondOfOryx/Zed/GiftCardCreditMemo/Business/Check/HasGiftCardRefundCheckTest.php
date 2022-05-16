<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business\Check;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface;

class HasGiftCardRefundCheckTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardCreditMemo\Dependency\Facade\GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoGiftCardConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardCreditMemo\Business\Check\HasGiftCardRefundCheckInterface
     */
    protected $check;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoGiftCardConnectorFacadeMock = $this->getMockBuilder(GiftCardCreditMemoToCreditMemoGiftCardConnectorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->check = new HasGiftCardRefundCheck(
            $this->creditMemoGiftCardConnectorFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCheckWillReturnTrue(): void
    {
        $this->creditMemoGiftCardConnectorFacadeMock->expects(static::once())
            ->method('findCreditMemoGiftCardsByIdSalesOrderItem')
            ->willReturn([1]);

        $this->check->check(1);
    }

    /**
     * @return void
     */
    public function testCheckWillReturnFalse(): void
    {
        $this->creditMemoGiftCardConnectorFacadeMock->expects(static::once())
            ->method('findCreditMemoGiftCardsByIdSalesOrderItem')
            ->willReturn([]);

        $this->check->check(1);
    }
}
