<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Communication\Controller;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence\RepresentativeCompanyUserRestApiPermissionRepository;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

class GatewayControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Persistence\RepresentativeCompanyUserRestApiPermissionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserRestApiPermissionRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApiPermission\Communication\Controller\GatewayController
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->repositoryMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected $representativeCompanyUserRestApiPermissionRepository;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\AbstractRepository $repository
             */
            public function __construct(AbstractRepository $repository)
            {
                $this->representativeCompanyUserRestApiPermissionRepository = $repository;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\AbstractRepository
             */
            protected function getRepository()
            {
                return $this->representativeCompanyUserRestApiPermissionRepository;
            }
        };
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageGlobalRepresentationsAction(): void
    {
        $self = $this;

        $permissionKey = 'permission_key';
        $custRef = 'cust_ref';

        $callCount = $this->atLeastOnce();
        $this->repositoryMock->expects($callCount)
            ->method('hasPermission')
            ->willReturnCallback(static function (string $permissionKeyFn, string $customerReference) use ($self, $callCount, $custRef, $permissionKey) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($permissionKey, $permissionKeyFn);

                        return true;
                    case 2:
                        $self->assertSame($custRef, $customerReference);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getPermissionKey')
            ->willReturn($permissionKey);

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOriginatorReference')
            ->willReturn($custRef);

        $this->gatewayController->hasPermissionToManageGlobalRepresentationsAction($this->representativeCompanyUserRestApiPermissionRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testHasPermissionToManageOwnRepresentationsAction(): void
    {
        $self = $this;

        $permissionKey = 'permission_key';
        $custRef = 'cust_ref';

        $callCount = $this->atLeastOnce();
        $this->repositoryMock->expects($callCount)
            ->method('hasPermission')
            ->willReturnCallback(static function (string $permissionKeyFn, string $customerReference) use ($self, $callCount, $custRef, $permissionKey) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($permissionKey, $permissionKeyFn);

                        return true;
                    case 2:
                        $self->assertSame($custRef, $customerReference);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getPermissionKey')
            ->willReturn($permissionKey);

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOriginatorReference')
            ->willReturn($custRef);

        $this->gatewayController->hasPermissionToManageOwnRepresentationsAction($this->representativeCompanyUserRestApiPermissionRequestTransferMock);
    }
}
