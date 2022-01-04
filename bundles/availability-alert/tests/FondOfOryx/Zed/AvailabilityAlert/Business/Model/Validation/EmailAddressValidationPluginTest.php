<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Exception\SubscriberEmailInvalidException;
use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class EmailAddressValidationPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriberTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation\ValidationPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriberTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriberTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new EmailAddressValidationPlugin();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::once())->method('getEmail')->willReturn('foo@bar.com');

        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail2(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('-5692)) OR 9375=(SELECT (CASE WHEN (9375=9288) THEN 9375 ELSE (SELECT 9288 UNION SELECT 3111) END))-- sYor');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail3(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('1zqjar\'"(){}<x>:/1zqjar;9');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail4(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('DkyB\') PROCEDURE ANALYSE(EXTRACTVALUE(2092,CONCAT(0x5c,0x71716a6b71,(SELECT (CASE WHEN (2092=2092) THEN 1 ELSE 0 END)),0x7171787671)),1) AND (\'XJVC\'=\'XJVC');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail5(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('requireSubscriber')->willReturnSelf();
        $this->subscriptionTransferMock->expects(static::once())->method('getSubscriber')->willReturn($this->subscriberTransferMock);
        $this->subscriberTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('(CAST((CHR(113)||CHR(113)||CHR(106)||CHR(107)||CHR(113))||(SELECT (CASE WHEN (5305=5305) THEN 1 ELSE 0 END))::text||(CHR(113)||CHR(113)||CHR(120)||CHR(118)||CHR(113)) AS NUMERIC))');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }
}
