<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleExpanderTest extends Unit
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
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

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
        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)->disableOriginalConstructor()->getMock();
        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface::class)->disableOriginalConstructor()->getMock();
        $this->companyFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToCompanyFacadeInterface::class)->disableOriginalConstructor()->getMock();
        $this->localeFacadeMock = $this->getMockBuilder(CompanyOmsMailConnectorToLocaleFacadeInterface::class)->disableOriginalConstructor()->getMock();

        $this->expander = new LocaleExpander($this->companyUserReferenceFacadeMock, $this->localeFacadeMock, $this->companyFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferMock->expects(static::once())->method('getCompany')->willReturn($this->companyTransferMock);
        $this->companyTransferMock->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(1);
        $this->companyUserTransferMock->expects(static::never())->method('getFkCompany');
        $this->mailTransferMock->expects(static::exactly(2))->method('setCompanyUser')->with($this->companyUserTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::once())->method('setLocale')->with($this->localeTransferMock)->willReturnSelf();
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getLocaleById')->willReturn($this->localeTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getAvailableLocales')->willReturn([1 => 'de_DE']);
        $this->companyFacadeMock->expects(static::never())->method('findCompanyById');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandWithFallbackLocale(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferMock->expects(static::once())->method('getCompany')->willReturn($this->companyTransferMock);
        $this->companyTransferMock->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(45);
        $this->mailTransferMock->expects(static::exactly(2))->method('setCompanyUser')->with($this->companyUserTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::once())->method('setLocale')->with($this->localeTransferMock)->willReturnSelf();
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getLocaleById')->withConsecutive([1])->willReturn($this->localeTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getAvailableLocales')->willReturn([1 => 'de_DE']);
        $this->companyFacadeMock->expects(static::never())->method('findCompanyById');
        $this->companyUserTransferMock->expects(static::never())->method('getFkCompany');

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandWithFallbackLocale2(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferMock->expects(static::once())->method('getCompany');
        $this->companyTransferMock->expects(static::never())->method('getFkLocale');
        $this->mailTransferMock->expects(static::once())->method('setCompanyUser')->with($this->companyUserTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::once())->method('setLocale')->with($this->localeTransferMock)->willReturnSelf();
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getLocaleById')->withConsecutive([1])->willReturn($this->localeTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getAvailableLocales')->willReturn([1 => 'de_DE']);
        $this->companyFacadeMock->expects(static::once())->method('findCompanyById');
        $this->companyUserTransferMock->expects(static::once())->method('getFkCompany')->willReturn(1);

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }

    /**
     * @return void
     */
    public function testExpandWithFetchedCompanyLocale(): void
    {
        $this->mailTransferMock->expects(static::once())->method('getCompanyUser')->willReturn(null);
        $this->orderTransferMock->expects(static::once())->method('getCompanyUserReference')->willReturn('companyUserReference');
        $this->companyUserTransferMock->expects(static::never())->method('getCompanyUserReference');
        $this->companyUserTransferMock->expects(static::once())->method('getCompany');
        $this->companyTransferMock->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(1);
        $this->companyUserTransferMock->expects(static::once())->method('setCompany');
        $this->mailTransferMock->expects(static::exactly(2))->method('setCompanyUser')->with($this->companyUserTransferMock)->willReturnSelf();
        $this->mailTransferMock->expects(static::once())->method('setLocale')->with($this->localeTransferMock)->willReturnSelf();
        $this->companyUserReferenceFacadeMock->expects(static::once())->method('findCompanyUserByCompanyUserReference')->willReturn($this->companyUserResponseTransferMock);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getIsSuccessful')->willReturn(true);
        $this->companyUserResponseTransferMock->expects(static::once())->method('getCompanyUser')->willReturn($this->companyUserTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getLocaleById')->withConsecutive([1])->willReturn($this->localeTransferMock);
        $this->localeFacadeMock->expects(static::once())->method('getAvailableLocales')->willReturn([1 => 'de_DE']);
        $this->companyFacadeMock->expects(static::once())->method('findCompanyById')->willReturn($this->companyTransferMock);
        $this->companyUserTransferMock->expects(static::once())->method('getFkCompany')->willReturn(1);

        $this->expander->expand($this->mailTransferMock, $this->orderTransferMock);
    }
}
