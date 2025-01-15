<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\LocaleExpander;
use FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\MailExpander;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CompanyOmsMailConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\MailExpander
     */
    protected $mailExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\LocaleExpander
     */
    protected $localeExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MailTransfer
     */
    protected $mailTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\OrderTransfer
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Business\CompanyOmsMailConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyOmsMailConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailExpanderMock = $this->getMockBuilder(MailExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeExpanderMock = $this->getMockBuilder(LocaleExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyOmsMailConnectorFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandOrderMailTransferWithCompanyMailAddress(): void
    {
        $self = $this;

        $this->businessFactoryMock->expects(static::once())
            ->method('createMailExpander')
            ->willReturn($this->mailExpanderMock);

        $callCount = $this->atLeastOnce();
        $this->mailExpanderMock->expects($callCount)
            ->method('expand')
            ->willReturnCallback(static function (MailTransfer $mailTransfer, OrderTransfer $orderTransfer) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($self->mailTransferMock, $mailTransfer);
                        $self->assertSame($self->orderTransferMock, $orderTransfer);

                        return $self->mailTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->mailTransferMock,
            $this->facade->expandOrderMailTransferWithCompanyMailAddress($this->mailTransferMock, $this->orderTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandOrderMailTransferWithCompanyLocale(): void
    {
        $self = $this;

        $this->businessFactoryMock->expects(static::once())
            ->method('createLocaleExpander')
            ->willReturn($this->mailExpanderMock);

        $callCount = $this->atLeastOnce();
        $this->mailExpanderMock->expects($callCount)
            ->method('expand')
            ->willReturnCallback(static function (MailTransfer $mailTransfer, OrderTransfer $orderTransfer) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($self->mailTransferMock, $mailTransfer);
                        $self->assertSame($self->orderTransferMock, $orderTransfer);

                        return $self->mailTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->mailTransferMock,
            $this->facade->expandOrderMailTransferWithCompanyLocale($this->mailTransferMock, $this->orderTransferMock),
        );
    }
}
