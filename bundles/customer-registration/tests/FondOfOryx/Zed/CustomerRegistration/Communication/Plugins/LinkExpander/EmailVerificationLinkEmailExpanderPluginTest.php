<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkEmailExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander\EmailVerificationLinkEmailExpanderPlugin
     */
    protected $emailVerificationLinkEmailExpanderPlugin;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailVerificationLinkEmailExpanderPlugin = new EmailVerificationLinkEmailExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $link = '{{email}}';
        $email = 'test@email.com';

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn($email);

        $this->assertSame(
            $email,
            $this->emailVerificationLinkEmailExpanderPlugin->expand($link, $this->customerTransferMock),
        );
    }
}
