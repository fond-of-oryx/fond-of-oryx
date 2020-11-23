<?php

namespace FondOfOryx\Zed\MailBcc\Business\Model\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\MailBcc\MailBccConfig;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

/**
 * Auto-generated group annotations
 *
 * @group FondOfOryx
 * @group Zed
 * @group MailBcc
 * @group Business
 * @group Model
 * @group Expander
 * @group MailBccExpanderTest
 * Add your own group annotations below this line
 */
class MailBccExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\MailBcc\MailBccConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailBcc\Business\Model\Expander\MailBccExpander
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(MailBccConfig::class)->disableOriginalConstructor()->getMock();
        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)->disableOriginalConstructor()->getMock();
        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->expander = new MailBccExpander($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpand()
    {
        $mailData = [
            'test@one.com' => 'Test 1',
            'test@two.com' => 'Test 2',
        ];
        $this->configMock->expects($this->once())->method('getBccEmailAddress')->willReturn($mailData);
        $this->mailTransferMock->expects($this->exactly(2))->method('addRecipientBcc')->willReturn($this->mailTransferMock);

        $this->assertInstanceOf(MailTransfer::class, $this->expander->expand($this->mailTransferMock, $this->orderTransferMock));
    }
}
