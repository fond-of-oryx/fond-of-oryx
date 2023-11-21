<?php

namespace FondOfOryx\Zed\CompanyUserMailConnector\Business\Mail;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandler;
use FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface;
use FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class MailHandlerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Dependency\Facade\CompanyUserMailConnectorToMailFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Model\Mail\MailHandlerInterface
     */
    protected $mailHandler;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserMailConnector\Business\Reader\LocaleReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LocaleReaderInterface|MockObject $localeReaderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeReaderMock = $this->getMockBuilder(LocaleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this
            ->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this
            ->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailFacadeMock = $this
            ->getMockBuilder(CompanyUserMailConnectorToMailFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this
            ->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailHandler = new MailHandler($this->localeReaderMock, $this->mailFacadeMock);
    }

    /**
     * @return void
     */
    public function testSendMail(): void
    {
        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(true);

        $this->localeReaderMock->expects(static::atLeastOnce())
            ->method('getByCustomer')
            ->with($this->customerTransferMock)
            ->willReturn($this->localeTransferMock);

        $this->mailFacadeMock->expects(static::atLeastOnce())
            ->method('handleMail');

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendMail(
                $this->companyUserTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSendMailWithNoNewCustomer(): void
    {
        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getIsNew')
            ->willReturn(false);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->mailHandler->sendMail(
                $this->companyUserTransferMock,
            ),
        );
    }
}
