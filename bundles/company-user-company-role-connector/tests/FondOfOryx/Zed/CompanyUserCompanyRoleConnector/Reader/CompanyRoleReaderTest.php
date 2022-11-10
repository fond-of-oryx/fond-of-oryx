<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleResponseTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyUsersRequestAttributesTransfer;

class CompanyRoleReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleResponseTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Reader\CompanyRoleReader
     */
    protected $reader;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleTransferMock;

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

        $this->companyRoleFacadeMock = $this
            ->getMockBuilder(CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleResponseTransferMock = $this
            ->getMockBuilder(CompanyRoleResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this
            ->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleTransferMock = $this
            ->getMockBuilder(RestCompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUsersRequestAttributesTransferMock = $this
            ->getMockBuilder(RestCompanyUsersRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new CompanyRoleReader(
            $this->companyRoleFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyUsersRequestAttributes(): void
    {
        $this->restCompanyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn($this->restCompanyRoleTransferMock);

        $this->restCompanyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->willReturn($this->companyRoleResponseTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleTransfer')
            ->willReturn($this->companyRoleTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        static::assertInstanceOf(
            CompanyRoleTransfer::class,
            $this->reader->getByRestCompanyUsersRequestAttributes(
                $this->restCompanyUsersRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyUsersRequestAttributesWithNullRestCompanyRoleTransfer(): void
    {
        $this->restCompanyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->willReturn(null);

        static::assertNull(
            $this->reader->getByRestCompanyUsersRequestAttributes(
                $this->restCompanyUsersRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetByRestCompanyUsersRequestAttributesWithNullCompanyRoleTransfer(): void
    {
        $this->restCompanyUsersRequestAttributesTransferMock->expects(static::atLeastOnce())
        ->method('getCompanyRole')
        ->willReturn($this->restCompanyRoleTransferMock);

        $this->restCompanyRoleTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoleByUuid')
            ->willReturn($this->companyRoleResponseTransferMock);

        $this->companyRoleResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleTransfer')
            ->willReturn(null);

        static::assertNull(
            $this->reader->getByRestCompanyUsersRequestAttributes(
                $this->restCompanyUsersRequestAttributesTransferMock,
            ),
        );
    }
}
