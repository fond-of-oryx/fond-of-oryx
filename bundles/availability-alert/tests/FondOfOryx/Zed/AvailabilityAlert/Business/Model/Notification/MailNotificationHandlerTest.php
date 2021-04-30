<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Notification;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailBridge;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\LocalizedUrlTransfer;
use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\ProductUrlTransfer;

class MailNotificationHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToMailInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToProductInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductUrlTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productUrlTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocalizedUrlTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localizedUrlTransfer;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransfer;

    /**
     * @var \Generated\Shared\Transfer\PriceProductTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $priceProductTransfer;

    /**
     * @var \Generated\Shared\Transfer\MoneyValueTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $moneyValueTransfer;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\Notification\MailNotificationHandler
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->mailFacadeMock = static::getMockBuilder(AvailabilityAlertToMailBridge::class)->disableOriginalConstructor()->getMock();
        $this->productFacadeMock = static::getMockBuilder(AvailabilityAlertToProductBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->productAbstractTransferMock = static::getMockBuilder(ProductAbstractTransfer::class)->disableOriginalConstructor()->getMock();
        $this->productUrlTransferMock = static::getMockBuilder(ProductUrlTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localizedUrlTransfer = static::getMockBuilder(LocalizedUrlTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransfer = static::getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();
        $this->priceProductTransfer = static::getMockBuilder(PriceProductTransfer::class)->disableOriginalConstructor()->getMock();
        $this->moneyValueTransfer = static::getMockBuilder(MoneyValueTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new MailNotificationHandler($this->mailFacadeMock, $this->productFacadeMock, '');
    }

    /**
     * @return void
     */
    public function testNotify(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('getProductAbstract')->willReturn($this->productAbstractTransferMock);
        $this->productFacadeMock->expects(static::once())->method('getProductUrl')->willReturn($this->productUrlTransferMock);
        $this->productAbstractTransferMock->expects(static::once())->method('getPrices')->willReturn([$this->priceProductTransfer]);
        $this->productUrlTransferMock->expects(static::once())->method('getUrls')->willReturn([$this->localizedUrlTransfer]);
        $this->localizedUrlTransfer->expects(static::once())->method('getLocale')->willReturn($this->localeTransfer);
        $this->localeTransfer->expects(static::once())->method('getIdLocale')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::once())->method('getFkLocale')->willReturn(1);
        $this->priceProductTransfer->expects(static::once())->method('getMoneyValue')->willReturn($this->moneyValueTransfer);
        $this->subscriptionTransferMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransfer);
        $this->mailFacadeMock->expects(static::once())->method('handleMail');

        $this->handler->notify($this->subscriptionTransferMock);
    }
}
