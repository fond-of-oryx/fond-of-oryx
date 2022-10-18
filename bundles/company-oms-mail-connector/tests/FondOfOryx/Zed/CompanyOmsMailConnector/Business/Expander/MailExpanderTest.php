<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class MailExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\MailRecipientTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailRecipientTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander\ExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)->disableOriginalConstructor()->getMock();
        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyUserTransferTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyBusinessUnitTransferTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->mailRecipientTransferMock = $this->getMockBuilder(MailRecipientTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->expander = new MailExpander($this->companyUserReferenceFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferTransferMock->expects(static::once())->method('getCompanyBusinessUnit')->willReturn($this->companyBusinessUnitTransferTransferMock);
        $this->mailTransferMock->expects(static::once())->method('setCompanyUser')->with($this->companyUserTransferTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::atLeastOnce())->method('getRecipients')->willReturn(new ArrayObject());
        $this->mailTransferMock->expects(static::once())->method('addRecipient')->willReturnCallback(static function (MailRecipientTransfer $recipientTransfer) {
            static::assertSame($recipientTransfer->getName(), 'FOO Company GmbH');
            static::assertSame($recipientTransfer->getEmail(), 'unit@codeception.test');
        });
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferTransferMock);
        $this->companyBusinessUnitTransferTransferMock->expects(static::once())->method('getEmail')->willReturn('unit@codeception.test');
        $this->companyBusinessUnitTransferTransferMock->expects(static::once())->method('getName')->willReturn('FOO Company GmbH');
        $this->orderTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('order@codeception.test');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandWithAlreadySetRecipient(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferTransferMock->expects(static::once())->method('getCompanyBusinessUnit')->willReturn($this->companyBusinessUnitTransferTransferMock);
        $this->mailTransferMock->expects(static::once())->method('setCompanyUser')->with($this->companyUserTransferTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::atLeastOnce())->method('getRecipients')->willReturn(new ArrayObject([$this->mailRecipientTransferMock]));
        $this->mailTransferMock->expects(static::never())->method('addRecipient');
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferTransferMock);
        $this->companyBusinessUnitTransferTransferMock->expects(static::once())->method('getEmail')->willReturn('unit@codeception.test');
        $this->mailRecipientTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('unit@codeception.test');
        $this->orderTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('order@codeception.test');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandAlreadyHasCompanyUserTransfer(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferTransferMock);
        $this->orderTransferMock->expects(static::atLeastOnce())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferTransferMock->expects(static::once())->method('getCompanyBusinessUnit')->willReturn($this->companyBusinessUnitTransferTransferMock);
        $this->mailTransferMock->expects(static::never())->method('setCompanyUser');
        $this->mailTransferMock->expects(static::atLeastOnce())->method('getRecipients')->willReturn(new ArrayObject());
        $this->mailTransferMock->expects(static::once())->method('addRecipient')->willReturnCallback(static function (MailRecipientTransfer $recipientTransfer) {
            static::assertSame($recipientTransfer->getName(), 'FOO Company GmbH');
            static::assertSame($recipientTransfer->getEmail(), 'unit@codeception.test');
        });
        $this->companyUserReferenceFacadeMock->expects(static::never())->method('findCompanyUserByCompanyUserReference');
        $this->companyUserResponseTransferMock->expects(static::never())->method('getIsSuccessful');
        $this->companyUserResponseTransferMock->expects(static::never())->method('getCompanyUser');
        $this->companyBusinessUnitTransferTransferMock->expects(static::once())->method('getEmail')->willReturn('unit@codeception.test');
        $this->companyBusinessUnitTransferTransferMock->expects(static::once())->method('getName')->willReturn('FOO Company GmbH');
        $this->orderTransferMock->expects(static::atLeastOnce())->method('getEmail')->willReturn('order@codeception.test');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }
}
