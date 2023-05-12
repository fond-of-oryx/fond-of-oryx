<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunnerInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representationManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\CompanyUserManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserManagerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task\TaskRunnerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $taskRunnerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserReaderMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserCollectionTransfer;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $commandTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationManagerMock = $this->getMockBuilder(RepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserManagerMock = $this->getMockBuilder(CompanyUserManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserReaderMock = $this->getMockBuilder(RepresentativeCompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->taskRunnerMock = $this->getMockBuilder(TaskRunnerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserCollectionTransfer = $this->getMockBuilder(RepresentativeCompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->commandTransferMock = $this->getMockBuilder(RepresentativeCompanyUserCommandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new RepresentativeCompanyUserFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCheckForExpiration(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('checkForExpiration')
            ->with($this->filterTransferMock);

        $this->facade->checkForExpiration($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckForActivation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('checkForActivation')
            ->with($this->filterTransferMock);

        $this->facade->checkForActivation($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckForRevocation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('checkForRevocation')
            ->with($this->filterTransferMock);

        $this->facade->checkForRevocation($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateRepresentativeCompanyUser(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('addRepresentation')
            ->with($this->representativeCompanyUserTransferMock)
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->facade->createRepresentativeCompanyUser($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserForRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserManager')
            ->willReturn($this->companyUserManagerMock);

        $this->companyUserManagerMock->expects(static::atLeastOnce())
            ->method('deleteCompanyUserForRepresentation')
            ->with($this->representativeCompanyUserTransferMock);

        $this->facade->deleteCompanyUserForRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserForRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserManager')
            ->willReturn($this->companyUserManagerMock);

        $this->companyUserManagerMock->expects(static::atLeastOnce())
            ->method('createCompanyUserForRepresentation')
            ->with($this->representativeCompanyUserTransferMock);

        $this->facade->createCompanyUserForRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testSetRepresentationState(): void
    {
        $uuid = 'uuid';
        $state = 'state';

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->with($uuid, $state)
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->facade->setRepresentationState($uuid, $state);
    }

    /**
     * @return void
     */
    public function testGetAndFlagInProcessNewRepresentativeCompanyUser(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserReader')
            ->willReturn($this->representativeCompanyUserReaderMock);

        $this->representativeCompanyUserReaderMock->expects(static::atLeastOnce())
            ->method('getAndFlagInProcessNewRepresentativeCompanyUser')
            ->with($this->filterTransferMock)
            ->willReturn($this->representativeCompanyUserCollectionTransfer);

        $this->facade->getAndFlagInProcessNewRepresentativeCompanyUser($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testSetInProcess(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->representationManagerMock);

        $this->representationManagerMock->expects(static::atLeastOnce())
            ->method('setAllInProcess')
            ->with($this->representativeCompanyUserCollectionTransfer)
            ->willReturn($this->representativeCompanyUserCollectionTransfer);

        $this->facade->setInProcess($this->representativeCompanyUserCollectionTransfer);
    }

    /**
     * @return void
     */
    public function testRunTask(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTaskRunner')
            ->willReturn($this->taskRunnerMock);

        $this->taskRunnerMock->expects(static::atLeastOnce())
            ->method('runTask')
            ->with($this->commandTransferMock);

        $this->facade->runTask($this->commandTransferMock);
    }

    /**
     * @return void
     */
    public function testGetRegisteredProcessorNames(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTaskRunner')
            ->willReturn($this->taskRunnerMock);

        $this->taskRunnerMock->expects(static::atLeastOnce())
            ->method('getRegisteredProcessorNames')->willReturn([]);

        $this->facade->getRegisteredProcessorNames();
    }
}
