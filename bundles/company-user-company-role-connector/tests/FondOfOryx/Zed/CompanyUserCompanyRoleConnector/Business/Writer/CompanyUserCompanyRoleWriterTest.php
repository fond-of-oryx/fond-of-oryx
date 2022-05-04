<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRolConnector\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriter;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyIdMismatchException;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Exception\CompanyRoleNotFoundException;
use Generated\Shared\Transfer\CompanyRoleResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyUserCompanyRoleWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleResponseTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUsersRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriter
     */
    protected $companyUserCompanyRoleWriter;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleFacadeMock = $this
            ->getMockBuilder(CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleResponseTransferMock = $this->getMockBuilder(CompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleTransferMock = $this->getMockBuilder(RestCompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUsersRequestAttributesTransferMock = $this
            ->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCompanyRoleWriter = new CompanyUserCompanyRoleWriter($this->companyRoleFacadeMock);
    }

    /**
     * @return void
     */
    public function testSaveCompanyUserCompanyRole(): void
    {
        $this->companyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn($this->restCompanyRoleTransferMock);

        $this->restCompanyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn(1);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->willReturn($this->companyRoleResponseTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleTransfer')
            ->willReturn($this->companyRoleTransferMock);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyRoleCollection')
            ->willReturnSelf();

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('saveCompanyUser');

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->companyUserCompanyRoleWriter->saveCompanyUserCompanyRole(
                $this->companyUserTransferMock,
                $this->companyUsersRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyUserCompanyRoleWithMissingCompanyRoleInRequest(): void
    {
        $this->companyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn(null);

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->companyUserCompanyRoleWriter->saveCompanyUserCompanyRole(
                $this->companyUserTransferMock,
                $this->companyUsersRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyUserCompanyRoleMissingRompanyRole(): void
    {
        $this->companyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn($this->restCompanyRoleTransferMock);

        $this->restCompanyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn(1);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->willReturn($this->companyRoleResponseTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->expectException(CompanyRoleNotFoundException::class);

        $this->companyUserCompanyRoleWriter->saveCompanyUserCompanyRole(
            $this->companyUserTransferMock,
            $this->companyUsersRequestAttributesTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyUserCompanyRoleWithIdMissmatch(): void
    {
        $this->companyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn($this->restCompanyRoleTransferMock);

        $this->restCompanyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn(1);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->willReturn($this->companyRoleResponseTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleTransfer')
            ->willReturn($this->companyRoleTransferMock);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(2);

        $this->expectException(CompanyIdMismatchException::class);

        $this->companyUserCompanyRoleWriter->saveCompanyUserCompanyRole(
            $this->companyUserTransferMock,
            $this->companyUsersRequestAttributesTransferMock,
        );
    }
}
