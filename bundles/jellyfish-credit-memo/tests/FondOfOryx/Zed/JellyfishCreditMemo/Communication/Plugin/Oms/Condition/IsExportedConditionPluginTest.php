<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Condition;

use Codeception\Test\Unit;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem;
use Orm\Zed\CreditMemo\Persistence\Map\FooCreditMemoTableMap;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class IsExportedConditionPluginTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoItemMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Condition\IsExportedConditionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->fooCreditMemoMock = $this->getMockBuilder(FooCreditMemo::class)->disableOriginalConstructor()->getMock();
        $this->fooCreditMemoItemMock = $this->getMockBuilder(FooCreditMemoItem::class)->disableOriginalConstructor()->getMock();
        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new IsExportedConditionPlugin();
    }

    /**
     * @return void
     */
    public function testCheckNoItems(): void
    {
        $this->spySalesOrderItemMock->expects(static::once())->method('getFooCreditMemoItems')->willReturn([]);

        static::assertTrue($this->plugin->check($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->spySalesOrderItemMock->expects(static::once())->method('getFooCreditMemoItems')->willReturn([$this->fooCreditMemoItemMock]);
        $this->fooCreditMemoItemMock->expects(static::once())->method('getFooCreditMemo')->willReturn($this->fooCreditMemoMock);
        $this->fooCreditMemoMock->expects(static::once())->method('getJellyfishExportState')->willReturn(FooCreditMemoTableMap::COL_STATE_COMPLETE);

        static::assertTrue($this->plugin->check($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckWillReturnFalse(): void
    {
        $this->spySalesOrderItemMock->expects(static::once())->method('getFooCreditMemoItems')->willReturn([$this->fooCreditMemoItemMock]);
        $this->fooCreditMemoItemMock->expects(static::once())->method('getFooCreditMemo')->willReturn($this->fooCreditMemoMock);
        $this->fooCreditMemoMock->expects(static::once())->method('getJellyfishExportState')->willReturn('test');

        static::assertFalse($this->plugin->check($this->spySalesOrderItemMock));
    }
}
