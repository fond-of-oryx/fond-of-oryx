<?php

namespace FondOfOryx\Zed\CompaniesRestApiPermission\Communication\Controller;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $permissionKey = 'permission_key';
        $custRef = 'cust_ref';
        $uuid = 'uuid';

        $callCount = $this->atLeastOnce();
        $this->repositoryMock->expects($callCount)
            ->method('hasPermissionToDeleteCompany')
            ->willReturnCallback(static function (string $key) use ($self, $callCount, $permissionKey, $custRef, $uuid) {
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
                        $self->assertSame($permissionKey, $key);

                        return true;
                    case 2:
                        $self->assertSame($custRef, $key);

                        return true;
                    case 3:
                        $self->assertSame($uuid, $key);

                        return true;
                }

                throw new Exception('Unexpected call count');
            });

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
