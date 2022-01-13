<?php

namespace FondOfOryx\Zed\OrderBudget\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface;

class OrderBudgetToUtilDateTimeServiceBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilDateTime\UtilDateTimeServiceInterface|mixed
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
            $this->utilDateTimeServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testFormatDate(): void
    {
        $dateTime = '2022-01-01 02:00:00';
        $date = '2022-01-01';

        $this->utilDateTimeServiceMock->expects(static::atLeastOnce())
            ->method('formatDate')
            ->with($dateTime)
            ->willReturn($date);

        static::assertEquals(
            $date,
            $this->orderBudgetToUtilDateTimeServiceBridge->formatDate($dateTime),
        );
    }
}
