<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompaniesRestApiPermission\Persistence\CompaniesRestApiPermissionRepository;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompaniesRestApiPermission\Persistence\CompaniesRestApiPermissionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companiesRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApiPermission\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompaniesRestApiPermissionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiPermissionRequestTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->repositoryMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected $companiesRestApiRepository;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\AbstractRepository $repository
             */
            public function __construct(AbstractRepository $repository)
            {
                $this->companiesRestApiRepository = $repository;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected function getRepository()
            {
                return $this->companiesRestApiRepository;
            }
        };
    }

    /**
     * @return void
     */
    public function testHasPermissionToDeleteCompanyAction(): void
    {
        $permissionKey = 'permission_key';
        $custRef = 'cust_ref';
        $uuid = 'uuid';

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermissionToDeleteCompany')
            ->withConsecutive(
                [$permissionKey],
                [$custRef],
                [$uuid],
            )
            ->willReturn(true);

        $this->companiesRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getPermissionKey')
            ->willReturn($permissionKey);

        $this->companiesRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($custRef);

        $this->companiesRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUuid')
            ->willReturn($uuid);

        $this->gatewayController->hasPermissionToDeleteCompanyAction($this->companiesRestApiPermissionRequestTransferMock);
    }
}
