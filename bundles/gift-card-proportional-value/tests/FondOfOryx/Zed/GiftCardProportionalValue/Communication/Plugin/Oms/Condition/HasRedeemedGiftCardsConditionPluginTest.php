<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Condition;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacade;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class HasRedeemedGiftCardsConditionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\GiftCardProportionalValueFacadeInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Communication\Plugin\Oms\Condition\HasRedeemedGiftCardsConditionPlugin
     */
    protected $condition;

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

        $this->spySalesOrderItemMock =
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->condition = new HasRedeemedGiftCardsConditionPlugin();
        $this->condition->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('hasRedeemedGiftCards')->willReturn(true);
        $this->condition->check($this->spySalesOrderItemMock);
    }
}
