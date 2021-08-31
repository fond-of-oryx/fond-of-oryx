<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

use Codeception\Test\Unit;
use DateTime;
use Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface;

class OrderBudgetToUtilDateTimeServiceBridgeTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface
     */
    protected $utilDateTimeServiceMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceBridge
     */
    protected $orderBudgetToUtilDateTimeServiceBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilDateTimeServiceMock = $this->getMockBuilder(UtilDateTimeServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetToUtilDateTimeServiceBridge = new OrderBudgetToUtilDateTimeServiceBridge(
            $this->utilDateTimeServiceMock
        );
    }

    /**
     * @return void
     */
    public function testFormatDateTime(): void
    {
        $dateTime = new DateTime();
        $formattedDateTime = $dateTime->format('Y-m-d H:i:s');

        $this->utilDateTimeServiceMock->expects(static::atLeastOnce())
            ->method('formatDateTime')
            ->with($dateTime)
            ->willReturn($formattedDateTime);

        static::assertEquals(
            $formattedDateTime,
            $this->orderBudgetToUtilDateTimeServiceBridge->formatDateTime($dateTime)
        );
    }
}
