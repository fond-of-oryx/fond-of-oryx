<?php

namespace FondOfOryx\Client\AvailabilityAlert\Validation;

use Codeception\Test\Unit;
use FondOfOryx\Client\AvailabilityAlert\Exception\SubscriberEmailInvalidException;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class EmailAddressValidationPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Client\AvailabilityAlertExtension\Dependency\Plugin\ValidationPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionRequestTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new EmailAddressValidationPlugin();
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->subscriptionTransferMock->expects(static::once())->method('getEmail')->willReturn('foo@bar.com');

        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail(): void
    {
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('foo@bar');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail2(): void
    {
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('-5692)) OR 9375=(SELECT (CASE WHEN (9375=9288) THEN 9375 ELSE (SELECT 9288 UNION SELECT 3111) END))-- sYor');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail3(): void
    {
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('1zqjar\'"(){}<x>:/1zqjar;9');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail4(): void
    {
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('DkyB\') PROCEDURE ANALYSE(EXTRACTVALUE(2092,CONCAT(0x5c,0x71716a6b71,(SELECT (CASE WHEN (2092=2092) THEN 1 ELSE 0 END)),0x7171787671)),1) AND (\'XJVC\'=\'XJVC');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }

    /**
     * @return void
     */
    public function testValidateWillFail5(): void
    {
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('(CAST((CHR(113)||CHR(113)||CHR(106)||CHR(107)||CHR(113))||(SELECT (CASE WHEN (5305=5305) THEN 1 ELSE 0 END))::text||(CHR(113)||CHR(113)||CHR(120)||CHR(118)||CHR(113)) AS NUMERIC))');

        $this->expectException(SubscriberEmailInvalidException::class);
        $this->plugin->validate($this->subscriptionTransferMock);
    }
}
