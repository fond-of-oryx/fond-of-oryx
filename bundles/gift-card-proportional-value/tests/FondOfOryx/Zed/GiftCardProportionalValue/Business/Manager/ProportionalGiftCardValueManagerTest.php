<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class ProportionalGiftCardValueManagerTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Executor\ProportionalValueCalculatorPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $pluginExecutorMock;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $proportionalGiftCardValueTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Manager\ProportionalGiftCardValueManagerInterface
     */
    protected $manager;

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

        $this->proportionalGiftCardValueTransferMock =
            $this->getMockBuilder(ProportionalGiftCardValueTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderItemMock =
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->readOnlyArrayObjectMock =
            $this->getMockBuilder(ReadOnlyArrayObject::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->pluginExecutorMock =
            $this->getMockBuilder(ProportionalValueCalculatorPluginExecutorInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->entityManagerMock =
            $this->getMockBuilder(GiftCardProportionalValueEntityManagerInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->manager = new ProportionalGiftCardValueManager($this->entityManagerMock, $this->pluginExecutorMock);
    }

    /**
     * @return void
     */
    public function testCreateProportionalValues(): void
    {
        $collection = new ArrayObject();
        $collection->append($this->proportionalGiftCardValueTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('execute')
            ->willReturn($collection);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('findOrCreateProportionalGiftCardValue')
            ->willReturn($this->proportionalGiftCardValueTransferMock);

        $this->manager->createProportionalValues([$this->spySalesOrderItemMock], $this->spySalesOrderMock, $this->readOnlyArrayObjectMock);
    }
}
