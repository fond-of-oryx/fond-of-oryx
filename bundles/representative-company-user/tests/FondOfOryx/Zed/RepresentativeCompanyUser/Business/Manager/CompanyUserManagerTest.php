<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyUserManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserEntityManagerInterface|MockObject $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManager
     */
    protected $manager;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager = new CompanyUserManager($this->repositoryMock, $this->entityManagerMock, $this->companyUserFacadeMock, $this->transactionHandlerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserForRepresentation(): void
    {
        $self = $this;

        $idDistributor = 1;
        $idCustomer = 2;

        $collectionClone = clone $this->companyUserCollectionTransferMock;
        $companyUserClone = clone $this->companyUserTransferMock;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function (callable $callback) {
                return call_user_func($callback);
            });

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkDistributor')
            ->willReturn($idDistributor);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentative')
            ->willReturn($this->customerTransferMock);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkRepresentative')
            ->willReturn($idCustomer);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn([$this->companyUserTransferMock]);

        $collectionClone->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn([$companyUserClone]);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setIdCompanyUser')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyUserReference')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setIsDefault')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerReference')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setFkCustomer')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->willReturnSelf();

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('setFkRepresentativeCompanyUser')
            ->willReturnSelf();

        $companyUserClone->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(2);

        $this->companyUserFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $callCount = $this->atLeastOnce();
        $this->repositoryMock->expects($callCount)
            ->method('getAllCompanyUserByCustomerId')
            ->willReturnCallback(static function (int $idCustomerFn) use ($self, $callCount, $collectionClone, $idDistributor, $idCustomer) {
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
                        $self->assertSame($idDistributor, $idCustomerFn);

                        return $self->companyUserCollectionTransferMock;
                    case 2:
                        $self->assertSame($idCustomer, $idCustomerFn);

                        return $collectionClone;
                }

                throw new Exception('Unexpected call count');
            });

        $this->manager->createCompanyUserForRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testDelete1CompanyUserForRepresentation(): void
    {
        $id = 1;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function (callable $callback) {
                return call_user_func($callback);
            });

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdRepresentativeCompanyUser')
            ->willReturn($id);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn([$this->companyUserTransferMock]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCompanyUserByIdRepresentativeCompanyUser')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserFacadeMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUser')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->manager->deleteCompanyUserForRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testFindByUuid(): void
    {
        $id = 1;

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function (callable $callback) {
                return call_user_func($callback);
            });

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getIdRepresentativeCompanyUser')
            ->willReturn($id);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn([$this->companyUserTransferMock]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCompanyUserByIdRepresentativeCompanyUser')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserFacadeMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUser')
            ->willReturn($this->companyUserResponseTransferMock);

        $this->companyUserResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->manager->deleteCompanyUserForRepresentation($this->representativeCompanyUserTransferMock);
    }
}
