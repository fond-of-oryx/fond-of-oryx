<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpanderInterface;
use Generated\Shared\Transfer\MailTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class FallbackLocaleMailProxyFacadeTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyBusinessFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FallbackLocaleMailProxyBusinessFactory $factoryMock;

    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpanderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailExpanderInterface $mailExpanderMock;

    /**
     * @var (\Generated\Shared\Transfer\MailTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyFacade
     */
    protected FallbackLocaleMailProxyFacade $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(FallbackLocaleMailProxyBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailExpanderMock = $this->getMockBuilder(MailExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new FallbackLocaleMailProxyFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandMail(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createMailExpander')
            ->willReturn($this->mailExpanderMock);

        $this->mailExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->mailTransferMock)
            ->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->facade->expandMail($this->mailTransferMock),
        );
    }
}
