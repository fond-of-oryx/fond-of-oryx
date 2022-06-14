<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Communication\Plugin;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorFacade;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Communication\Plugin\GiftCardProportionalValue\PayoneProportionalValueCalculationPlugin;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class NoPaymentProportionalValueCalculationPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\GiftCardProportionalValuePayoneConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValueExtension\Dependency\Plugin\ProportionalValueCalculationPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorFacade::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->plugin = new PayoneProportionalValueCalculationPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCalculate(): void
    {
        $values = new ArrayObject();

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isPayonePaymentMethod')
            ->willReturn(true);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('calculateProportionalGiftCardValues')
            ->willReturn($values);

        $this->plugin->calculate($this->spySalesOrderMock, $values);
    }

    /**
     * @return void
     */
    public function testCalculateOtherPaymentMethodsAvailable(): void
    {
        $values = new ArrayObject();

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('isPayonePaymentMethod')
            ->willReturn(false);

        $this->facadeMock->expects(static::never())
            ->method('calculateProportionalGiftCardValues');

        $this->plugin->calculate($this->spySalesOrderMock, $values);
    }
}
