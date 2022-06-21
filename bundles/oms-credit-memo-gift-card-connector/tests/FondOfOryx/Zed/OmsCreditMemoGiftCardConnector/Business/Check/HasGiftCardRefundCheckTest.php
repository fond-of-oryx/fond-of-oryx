<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface;

class HasGiftCardRefundCheckTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoGiftCardConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check\HasGiftCardRefundCheckInterface
     */
    protected $check;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoGiftCardConnectorFacadeMock = $this->getMockBuilder(OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface::class)
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
