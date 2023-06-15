<?php

namespace FondOfOryx\Zed\CompanyTypeRole\Business\Reader;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeRole\Business\Generator\AssignPermissionKeyGeneratorInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface;
use Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyRoleCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class AssignableCompanyRoleReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Generator\AssignPermissionKeyGeneratorInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $assignPermissionKeyGeneratorMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Reader\CompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToCompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Dependency\Facade\CompanyTypeRoleToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $permissionFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\AssignableCompanyRoleCriteriaFilterTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $assignableCompanyRoleCriteriaFilterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CompanyUserTransfer>
     */
    protected $companyUserTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleCollectionTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CompanyRoleTransfer>
     */
    protected $companyRoleTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeRole\Business\Reader\AssignableCompanyRoleReader
     */
    protected $assignableCompanyRoleReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->assignPermissionKeyGeneratorMock = $this->getMockBuilder(AssignPermissionKeyGeneratorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleFacadeMock = $this->getMockBuilder(CompanyTypeRoleToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyTypeRoleToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assignableCompanyRoleCriteriaFilterTransferMock = $this->getMockBuilder(AssignableCompanyRoleCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMocks = [
            $this->getMockBuilder(CompanyUserTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(CompanyUserTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->companyRoleCollectionTransferMock = $this->getMockBuilder(CompanyRoleCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMocks = [
            $this->getMockBuilder(CompanyRoleTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(CompanyRoleTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->assignableCompanyRoleReader = new AssignableCompanyRoleReader(
            $this->assignPermissionKeyGeneratorMock,
            $this->companyUserReaderMock,
            $this->companyRoleFacadeMock,
            $this->permissionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByAssignableCompanyRoleCriteriaFilter(): void
    {
        $idCompany = 1;
        $idCompanyUser = 1;
        $permissionKey = 'FooBar';

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getByAssignableCompanyRoleCriteriaFilter')
            ->with($this->assignableCompanyRoleCriteriaFilterTransferMock)
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn(new ArrayObject($this->companyUserTransferMocks));

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(null);

        $this->companyUserTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn(null);

        $this->companyUserTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn($idCompany);

        $this->companyUserTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCompanyUser')
            ->willReturn($idCompanyUser);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleCollection')
            ->with(
                static::callback(
                    static function (CompanyRoleCriteriaFilterTransfer $companyRoleCriteriaFilterTransfer) use ($idCompany) {
                        return $companyRoleCriteriaFilterTransfer->getIdCompany() === $idCompany;
                    },
                ),
            )->willReturn($this->companyRoleCollectionTransferMock);

        $this->companyRoleCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRoles')
            ->willReturn(new ArrayObject($this->companyRoleTransferMocks));

        $this->assignPermissionKeyGeneratorMock->expects(static::atLeastOnce())
            ->method('generateByCompanyRole')
            ->withConsecutive([$this->companyRoleTransferMocks[0]], [$this->companyRoleTransferMocks[1]])
            ->willReturnOnConsecutiveCalls($permissionKey, null);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with($permissionKey, $idCompanyUser)
            ->willReturn(true);

        $companyRoleCollectionTransfer = $this->assignableCompanyRoleReader->getByAssignableCompanyRoleCriteriaFilter(
            $this->assignableCompanyRoleCriteriaFilterTransferMock,
        );

        static::assertCount(
            1,
            $companyRoleCollectionTransfer->getRoles(),
        );

        static::assertEquals(
            $this->companyRoleTransferMocks[0],
            $companyRoleCollectionTransfer->getRoles()->offsetGet(0),
        );
    }
}
