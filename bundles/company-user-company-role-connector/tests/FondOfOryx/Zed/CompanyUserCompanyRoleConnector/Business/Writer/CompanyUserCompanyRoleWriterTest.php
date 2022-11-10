<?php

namespace FondOfOryx\Zed\CompanyUserCompanyRolConnector\Business\Writer;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpanderInterface;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Writer\CompanyUserCompanyRoleWriter;
use FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
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
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Business\Expander\CompanyUserExpanderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserExpanderMock;

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

        $this->companyUserExpanderMock = $this
            ->getMockBuilder(CompanyUserExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
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

        $this->companyUserCompanyRoleWriter = new CompanyUserCompanyRoleWriter(
            $this->companyUserExpanderMock,
            $this->companyRoleFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyUserCompanyRole(): void
    {
        $roles = new ArrayObject();
        $roles->append($this->companyRoleTransferMock);

        $this->companyUserExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->companyUserTransferMock, $this->companyUsersRequestAttributesTransferMock)
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn($roles);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('saveCompanyUser')
            ->with($this->companyUserTransferMock);

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
    public function testSaveCompanyUserCompanyRoleWithMissingCompanyRoleCollection(): void
    {
        $this->companyUserExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->companyUserTransferMock, $this->companyUsersRequestAttributesTransferMock)
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
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
    public function testSaveCompanyUserCompanyRoleMissingRompanyRoles(): void
    {
        $this->companyUserExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->companyUserTransferMock, $this->companyUsersRequestAttributesTransferMock)
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn(new ArrayObject());

        static::assertInstanceOf(
            CompanyUserTransfer::class,
            $this->companyUserCompanyRoleWriter->saveCompanyUserCompanyRole(
                $this->companyUserTransferMock,
                $this->companyUsersRequestAttributesTransferMock,
            ),
        );
    }
}
