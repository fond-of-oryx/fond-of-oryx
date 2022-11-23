<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReaderInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleReaderMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpander
     */
    protected $expander;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUsersRequestAttributesTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleReaderMock = $this
            ->getMockBuilder(CompanyRoleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this
            ->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this
            ->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersRequestAttributesTransferMock = $this
            ->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new CompanyUserExpander(
            $this->companyRoleReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->companyRoleReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompanyUsersRequestAttributes')
            ->with($this->restCompanyUsersRequestAttributesTransferMock)
            ->willReturn($this->companyRoleTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyRoleCollection')
            ->willReturnSelf();

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->expander->expand(
                $this->companyUserTransferMock,
                $this->restCompanyUsersRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithMissingCompanyRoleTransfer(): void
    {
        $this->companyRoleReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompanyUsersRequestAttributes')
            ->with($this->restCompanyUsersRequestAttributesTransferMock)
            ->willReturn(null);

        $this->expectException(CompanyRoleNotFoundException::class);

        $this->expander->expand(
            $this->companyUserTransferMock,
            $this->restCompanyUsersRequestAttributesTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testExpandWithFkCompanyIncompatibility(): void
    {
        $this->companyRoleReaderMock->expects(static::atLeastOnce())
            ->method('getByRestCompanyUsersRequestAttributes')
            ->with($this->restCompanyUsersRequestAttributesTransferMock)
            ->willReturn($this->companyRoleTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(2);

        $this->expectException(CompanyIdMismatchException::class);

        $this->expander->expand(
            $this->companyUserTransferMock,
            $this->restCompanyUsersRequestAttributesTransferMock,
        );
    }
}
