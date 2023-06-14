<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence\RepresentativeCompanyUserTradeFairRestApiPermissionRepository;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Persistence\RepresentativeCompanyUserTradeFairRestApiPermissionRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionRepository $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Controller\GatewayController
     */
    protected GatewayController $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->repositoryMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected $representativeCompanyUserTradeFairRestApiPermissionRepository;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\AbstractRepository $repository
             */
            public function __construct(AbstractRepository $repository)
            {
                $this->representativeCompanyUserTradeFairRestApiPermissionRepository = $repository;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected function getRepository()
            {
                return $this->representativeCompanyUserTradeFairRestApiPermissionRepository;
            }
        };
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageTradeFairRepresentationsAction(): void
    {
        $permissionKey = 'permission_key';
        $originatorReference = 'reference';

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->withConsecutive(
                [$permissionKey],
                [$originatorReference],
            )
            ->willReturn(true);

        $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getPermissionKey')
            ->willReturn($permissionKey);

        $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOriginatorReference')
            ->willReturn($originatorReference);

        $this->gatewayController
            ->hasPermissionToManageTradeFairRepresentationsAction(
                $this->representativeCompanyUserTradeFairRestApiPermissionRequestTransferMock,
            );
    }
}
