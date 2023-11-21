<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class TradeFairRepresentationManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence\RepresentativeCompanyUserTradeFairRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Dependency\Facade\RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTradeFairCollectionTransferMock;

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
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManager
     */
    protected $manager;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairToRepresentativeCompanyUserInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
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

        $this->manager = new TradeFairRepresentationManager(
            $this->entityManagerMock,
            $this->repositoryMock,
            $this->representativeCompanyUserFacadeMock,
            $this->transactionHandlerMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUserTradeFair')
            ->with($this->filterTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairCollectionTransferMock);

        $this->manager->get($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getFkDistributor')
            ->willReturn(1);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getFkOriginator')
            ->willReturn(2);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn('');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn('');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setActive')
            ->with(true);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('resolveDistributorFksToRepresent')
            ->willReturn([1]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->representativeCompanyUserFacadeMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function ($func) {
                return call_user_func($func);
            });

        $this->manager->create($this->representativeCompanyUserTradeFairTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getFkDistributor')
            ->willReturn(1);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getFkOriginator')
            ->willReturn(2);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn('');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn('');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getFkDistributor')
            ->willReturn(1);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn([]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkDistributor')
            ->willReturn(2);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setFkRepresentative')
            ->willReturnSelf();

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setState')
            ->with(FooRepresentativeCompanyUserTableMap::COL_STATE_NEW)
            ->willReturnSelf();

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setFkOriginator')
            ->willReturnSelf();

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setStartAt')
            ->willReturnSelf();

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setEndAt')
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUser')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findTradeFairByUuid')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('resolveDistributorFksToRepresent')
            ->willReturn([1]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->representativeCompanyUserFacadeMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->representativeCompanyUserFacadeMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function ($func) {
                return call_user_func($func);
            });

        $this->manager->update($this->representativeCompanyUserTradeFairTransferMock);
    }

    /**
     * @return void
     */
    public function testFindByUuid(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findRepresentativeCompanyUserTradeFairByUuid')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->manager->findByUuid('uuid');
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deactivate')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturnCallback(static function ($func) {
                return call_user_func($func);
            });

        $this->manager->delete('uuid');
    }
}
