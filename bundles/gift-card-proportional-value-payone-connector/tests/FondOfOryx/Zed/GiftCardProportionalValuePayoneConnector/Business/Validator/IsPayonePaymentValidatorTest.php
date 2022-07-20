<?php

namespace FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig;
use Orm\Zed\Payone\Persistence\SpyPaymentPayone;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Propel\Runtime\Collection\CollectionIterator;
use Propel\Runtime\Collection\ObjectCollection;

class IsPayonePaymentValidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\GiftCardProportionalValuePayoneConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \Orm\Zed\Payone\Persistence\SpyPaymentPayone|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyPaymentPayoneMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\CollectionIterator
     */
    protected $iteratorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValuePayoneConnector\Business\Validator\IsPayonePaymentValidatorInterface
     */
    protected $validator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock =
            $this->getMockBuilder(GiftCardProportionalValuePayoneConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spySalesOrderMock =
            $this->getMockBuilder(SpySalesOrder::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->spyPaymentPayoneMock =
            $this->getMockBuilder(SpyPaymentPayone::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->objectCollectionMock =
            $this->getMockBuilder(ObjectCollection::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->iteratorMock =
            $this->getMockBuilder(CollectionIterator::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->validator = new IsPayonePaymentValidator($this->configMock);
    }

    /**
     * @return void
     */
    public function testValidateTrue(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getSpyPaymentPayones')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(1);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('getIterator')
            ->willReturn($this->iteratorMock);

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('rewind');

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('current')
            ->willReturn($this->spyPaymentPayoneMock);

        $this->spyPaymentPayoneMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('cc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getPayonePaymentMethods')->willReturn([
                'paypal',
                'cc',
            ]);

        $this->configMock->expects(static::never())
            ->method('getListeningToAllPayonePaymentMethods');

        $this->assertTrue($this->validator->validate($this->spySalesOrderMock));
    }

    /**
     * @return void
     */
    public function testValidateFalseNotPayone(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getSpyPaymentPayones')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(0);

        $this->spyPaymentPayoneMock->expects(static::never())
            ->method('getPaymentMethod');

        $this->assertFalse($this->validator->validate($this->spySalesOrderMock));
    }

    /**
     * @return void
     */
    public function testValidateTrueAcceptAllPayoneMethods(): void
    {
        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getSpyPaymentPayones')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('count')
            ->willReturn(1);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('getIterator')
            ->willReturn($this->iteratorMock);

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('rewind');

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('current')
            ->willReturn($this->spyPaymentPayoneMock);

        $this->iteratorMock->expects(static::atLeastOnce())
            ->method('next');

        $this->spyPaymentPayoneMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('invoice');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getPayonePaymentMethods')->willReturn([
                'paypal',
                'cc',
            ]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getListeningToAllPayonePaymentMethods')->willReturn(true);

        $this->assertTrue($this->validator->validate($this->spySalesOrderMock));
    }
}
