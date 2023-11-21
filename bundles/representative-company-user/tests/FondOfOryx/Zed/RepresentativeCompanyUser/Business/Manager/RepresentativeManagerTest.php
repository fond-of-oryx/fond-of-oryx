<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $readerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventFacadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserCollectionTransferMock;

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
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager\RepresentationManager
     */
    protected $manager;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->readerMock = $this->getMockBuilder(RepresentativeCompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(RepresentativeCompanyUserEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserCollectionTransferMock = $this->getMockBuilder(RepresentativeCompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
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

        $this->manager = new RepresentationManager($this->entityManagerMock, $this->readerMock, $this->eventFacadeMock);
    }

    /**
     * @return void
     */
    public function testCheckForExpiration(): void
    {
        $this->filterTransferMock->expects(static::atLeastOnce())
            ->method('setStates');

        $this->readerMock->expects(static::atLeastOnce())
            ->method('getExpiredRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransferMock);

        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->eventFacadeMock->expects(static::atLeastOnce())
            ->method('trigger');

        $this->manager->checkForExpiration($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckForRevocation(): void
    {
        $this->readerMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUserByState')
            ->willReturn($this->representativeCompanyUserCollectionTransferMock);

        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->eventFacadeMock->expects(static::atLeastOnce())
            ->method('trigger');

        $this->manager->checkForRevocation($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckForActivation(): void
    {
        $this->filterTransferMock->expects(static::atLeastOnce())
            ->method('setStates');

        $this->readerMock->expects(static::atLeastOnce())
            ->method('getAndFlagInProcessNewRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransferMock);

        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->eventFacadeMock->expects(static::atLeastOnce())
            ->method('trigger');

        $this->manager->checkForActivation($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testGetRepresentativeCompanyUser(): void
    {
        $this->readerMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransferMock);

        $this->manager->getRepresentativeCompanyUser($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testAddRepresentation(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->addRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateRepresentation(): void
    {
        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->updateRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testFlagState(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->flagState('uuid', 'state');
    }

    /**
     * @return void
     */
    public function testFindByUuid(): void
    {
        $this->readerMock->expects(static::atLeastOnce())
            ->method('getRepresentationByUuid')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->findByUuid('uuid');
    }

    /**
     * @return void
     */
    public function testSetAllInProcess(): void
    {
        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('uuid');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->setAllInProcess($this->representativeCompanyUserCollectionTransferMock);
    }
}
