<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class ProportionalValueCalculatorPluginExecutorTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $calculationPluginMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface
     */
    protected $executor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->calculationPluginMock =
            $this->getMockBuilder(ProportionalValueCalculationPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->executor = new ProportionalValueCalculatorPluginExecutor([$this->calculationPluginMock]);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->calculationPluginMock->expects(static::atLeastOnce())
            ->method('calculate')
            ->willReturn(new ArrayObject());

        $this->executor->execute($this->spySalesOrderMock);
    }
}
