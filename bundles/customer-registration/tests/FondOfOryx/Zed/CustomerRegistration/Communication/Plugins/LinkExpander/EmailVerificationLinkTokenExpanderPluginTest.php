<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkTokenExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander\EmailVerificationLinkTokenExpanderPlugin
     */
    protected $emailVerificationLinkTokenExpanderPlugin;

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

        $this->emailVerificationLinkTokenExpanderPlugin = new EmailVerificationLinkTokenExpanderPlugin();
    }

    /**
     * @return void
     */
    protected function testExpand(): void
    {
        $token = 'token';
        $link = '{{token}}';

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getRegistrationKey')
            ->willReturn($token);

        $this->assertSame(
            $token,
            $this->emailVerificationLinkTokenExpanderPlugin->expand(
                $link,
                $this->customerTransferMock,
            ),
        );
    }
}
