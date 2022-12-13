<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms\Condition;

use Codeception\Test\Unit;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use FondOfOryx\Zed\Prepayment\PrepaymentConfig;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class IsAuthorizedPluginTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\Prepayment\PrepaymentConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->spySalesOrderItemMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();
        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)->disableOriginalConstructor()->getMock();
        $this->configMock = $this->getMockBuilder(PrepaymentConfig::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new IsAuthorizedPlugin();
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCheckTrue(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())->method('getOrder')->willReturn($this->spySalesOrderMock);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getFirstName')->willReturn('Foo');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getLastName')->willReturn('Bar');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar.de');
        $this->configMock->expects(static::atLeastOnce())->method('getForceInvalidMailAddresses')->willReturn(['foobar@test.de']);

        static::assertTrue($this->plugin->check($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckInvalidEmail(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())->method('getOrder')->willReturn($this->spySalesOrderMock);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getFirstName')->willReturn('Foo');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getLastName')->willReturn('Bar');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar.de');
        $this->configMock->expects(static::atLeastOnce())->method('getForceInvalidMailAddresses')->willReturn(['foo@bar.de']);

        static::assertFalse($this->plugin->check($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckInvalidFirstName(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())->method('getOrder')->willReturn($this->spySalesOrderMock);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getFirstName')->willReturn(PrepaymentConstants::FIRST_NAME_FOR_INVALID_TEST);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getLastName')->willReturn('Bar');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar.de');

        static::assertFalse($this->plugin->check($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testCheckInvalidLastName(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())->method('getOrder')->willReturn($this->spySalesOrderMock);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getFirstName')->willReturn('foo');
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getLastName')->willReturn(PrepaymentConstants::LAST_NAME_FOR_INVALID_TEST);
        $this->spySalesOrderMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar.de');

        static::assertFalse($this->plugin->check($this->spySalesOrderItemMock));
    }
}
