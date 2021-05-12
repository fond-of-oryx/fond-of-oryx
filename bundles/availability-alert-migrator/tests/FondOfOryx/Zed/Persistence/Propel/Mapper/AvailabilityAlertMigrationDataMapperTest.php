<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\AvailabilityAlertMigrationDataMapper;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription;
use Orm\Zed\Locale\Persistence\SpyLocale;

class AvailabilityAlertMigrationDataMapperTest extends Unit
{
    /**
     * @var \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fosAvailabilityAlertSubscriptionMock;

    /**
     * @var \Orm\Zed\Locale\Persistence\SpyLocale|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyLocaleMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander\ExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $expanderMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\AvailabilityAlertMigrationDataMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->fosAvailabilityAlertSubscriptionMock = $this->getMockBuilder(FosAvailabilityAlertSubscription::class)->disableOriginalConstructor()->getMock();
        $this->spyLocaleMock = $this->getMockBuilder(SpyLocale::class)->disableOriginalConstructor()->getMock();
        $this->expanderMock = $this->getMockBuilder(Expander::class)->disableOriginalConstructor()->getMock();

        $this->mapper = new AvailabilityAlertMigrationDataMapper($this->expanderMock);
    }

    /**
     * @return void
     */
    public function testFromFosAvailabilityAlertSubscription(): void
    {
        $this->expanderMock->expects(static::once())->method('expand')->willReturnCallback(static function ($entityTransfer, $transfer) {
            return $transfer;
        });
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::exactly(2))->method('getSentAt')->willReturn((new DateTime()));
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::exactly(2))->method('getCreatedAt')->willReturn((new DateTime()));
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getStatus')->willReturn('test');
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkLocale')->willReturn(2);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkStore')->willReturn(3);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getSpyLocale')->willReturn($this->spyLocaleMock);
        $this->spyLocaleMock->expects(static::once())->method('getLocaleName')->willReturn('de_DE');
        $transfer = $this->mapper->fromFosAvailabilityAlertSubscription($this->fosAvailabilityAlertSubscriptionMock);

        static::assertSame(1, $transfer->getFkProductAbstract());
        static::assertSame(2, $transfer->getFkLocale());
        static::assertSame(3, $transfer->getFkStore());
        static::assertSame('test', $transfer->getStatus());
        static::assertNotNull($transfer->getCreatedAt());
        static::assertNotNull($transfer->getUpdatedAt());
        static::assertNotNull($transfer->getSentAt());
    }

    /**
     * @return void
     */
    public function testFromFosAvailabilityAlertSubscriptionSentAtAndCreatedAtAreNull(): void
    {
        $this->expanderMock->expects(static::once())->method('expand')->willReturnCallback(static function ($entityTransfer, $transfer) {
            return $transfer;
        });
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getSentAt');
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getCreatedAt');
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkProductAbstract')->willReturn(1);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getStatus')->willReturn('test');
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkLocale')->willReturn(2);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getFkStore')->willReturn(3);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->fosAvailabilityAlertSubscriptionMock->expects(static::once())->method('getSpyLocale')->willReturn($this->spyLocaleMock);
        $this->spyLocaleMock->expects(static::once())->method('getLocaleName')->willReturn('de_DE');
        $transfer = $this->mapper->fromFosAvailabilityAlertSubscription($this->fosAvailabilityAlertSubscriptionMock);

        static::assertSame(1, $transfer->getFkProductAbstract());
        static::assertSame(2, $transfer->getFkLocale());
        static::assertSame(3, $transfer->getFkStore());
        static::assertSame('test', $transfer->getStatus());
        static::assertNull($transfer->getCreatedAt());
        static::assertNotNull($transfer->getUpdatedAt());
        static::assertNull($transfer->getSentAt());
    }
}
