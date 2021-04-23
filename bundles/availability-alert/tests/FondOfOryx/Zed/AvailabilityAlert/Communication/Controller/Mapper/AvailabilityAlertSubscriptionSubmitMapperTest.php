<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;

class AvailabilityAlertSubscriptionSubmitMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToStoreInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToLocaleInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionTransferExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $expanderMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\StoreTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper\AvailabilityAlertSubscriptionSubmitMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->storeFacadeMock = static::getMockBuilder(AvailabilityAlertToStoreBridge::class)->disableOriginalConstructor()->getMock();
        $this->localeFacadeMock = static::getMockBuilder(AvailabilityAlertToLocaleBridge::class)->disableOriginalConstructor()->getMock();
        $this->expanderMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransferExpander::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionRequestTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransferMock = static::getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();
        $this->storeTransferMock = static::getMockBuilder(StoreTransfer::class)->disableOriginalConstructor()->getMock();

        $this->mapper = new AvailabilityAlertSubscriptionSubmitMapper($this->localeFacadeMock, $this->storeFacadeMock, $this->expanderMock);
    }

    /**
     * @return void
     */
    public function testMapRequestTransfer(): void
    {
        $this->subscriptionRequestTransferMock->expects(static::once())->method('requireIdProductAbstract')->willReturn($this->subscriptionRequestTransferMock);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('requireEmail')->willReturn($this->subscriptionRequestTransferMock);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('requireLocaleName')->willReturn($this->subscriptionRequestTransferMock);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('modifiedToArray')->willReturn([]);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('getIdProductAbstract')->willReturn(1);
        $this->subscriptionRequestTransferMock->expects(static::once())->method('getLocaleName')->willReturn('test');
        $this->subscriptionRequestTransferMock->expects(static::once())->method('getStore')->willReturn('test');
        $this->subscriptionRequestTransferMock->expects(static::once())->method('toArray')->willReturn([]);
        $this->localeFacadeMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransferMock);
        $this->localeTransferMock->expects(static::once())->method('getIdLocale')->willReturn(1);
        $this->storeFacadeMock->expects(static::once())->method('getStore')->willReturn($this->storeTransferMock);
        $this->storeTransferMock->expects(static::once())->method('getIdStore')->willReturn(1);
        $this->expanderMock->expects(static::once())->method('expandWithSubscriptionRequest')->willReturn($this->subscriptionTransferMock);

        $response = $this->mapper->mapRequestTransfer($this->subscriptionRequestTransferMock);
        static::assertInstanceOf(AvailabilityAlertSubscriptionTransfer::class, $response);
    }
}
