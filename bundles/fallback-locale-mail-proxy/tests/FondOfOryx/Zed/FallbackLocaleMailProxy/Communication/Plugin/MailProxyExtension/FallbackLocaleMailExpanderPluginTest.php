<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Communication\Plugin\MailProxyExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyFacade;
use Generated\Shared\Transfer\MailTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class FallbackLocaleMailExpanderPluginTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FallbackLocaleMailProxyFacade|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\MailTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Communication\Plugin\MailProxyExtension\FallbackLocaleMailExpanderPlugin
     */
    protected FallbackLocaleMailExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(FallbackLocaleMailProxyFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new FallbackLocaleMailExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandMail')
            ->with($this->mailTransferMock)
            ->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->plugin->expand($this->mailTransferMock),
        );
    }
}
