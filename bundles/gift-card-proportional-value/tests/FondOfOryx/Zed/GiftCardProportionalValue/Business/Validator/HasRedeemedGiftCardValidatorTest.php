<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator;

use Codeception\Test\Unit;
use Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Propel\Runtime\Collection\ObjectCollection;

class HasRedeemedGiftCardValidatorTest extends Unit
{
    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderItemMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $spyGiftCardBalanceLogMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $objectCollectionMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Business\Validator\HasRedeemedGiftCardValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->spySalesOrderItemMock =
            $this->getMockBuilder(SpySalesOrderItem::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spyGiftCardBalanceLogMock =
            $this->getMockBuilder(SpyGiftCardBalanceLog::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->objectCollectionMock =
            $this->getMockBuilder(ObjectCollection::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->validator = new HasRedeemedGiftCardValidator();
    }

    /**
     * @return void
     */
    public function testValidateTrue(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->spySalesOrderMock);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getSpyGiftCardBalanceLogs')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(1);

        $this->assertTrue($this->validator->validate($this->spySalesOrderItemMock));
    }

    /**
     * @return void
     */
    public function testValidatefalse(): void
    {
        $this->spySalesOrderItemMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->spySalesOrderMock);

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getSpyGiftCardBalanceLogs')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(0);

        $this->assertFalse($this->validator->validate($this->spySalesOrderItemMock));
    }
}
