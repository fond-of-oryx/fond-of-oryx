<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Command;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacade;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class GiftCardProportionalValueCalculatorCommandPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderMock;

    /**
     * @var \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Command\GiftCardProportionalValueCalculatorCommandPlugin
     */
    protected $command;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock =
            $this->getMockBuilder(GiftCardProportionalValueFacade::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->readOnlyArrayObjectMock =
            $this->getMockBuilder(ReadOnlyArrayObject::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->command = new GiftCardProportionalValueCalculatorCommandPlugin();
        $this->command->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testRun(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('createProportionalValues')->willReturn([]);
        $this->command->run([], $this->spySalesOrderMock, $this->readOnlyArrayObjectMock);
    }
}
