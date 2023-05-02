<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriterInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentationManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $readerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer\RepresentativeCompanyUserWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $writerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserFacadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToEventFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventFacadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Service\RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $uuidGeneratorService;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

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

        $this->writerMock = $this->getMockBuilder(RepresentativeCompanyUserWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventFacadeMock = $this->getMockBuilder(RepresentativeCompanyUserToEventFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuidGeneratorService = $this->getMockBuilder(RepresentativeCompanyUserToUtilUuidGeneratorServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserCollectionTransferMock = $this->getMockBuilder(RepresentativeCompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager = new RepresentationManager($this->writerMock, $this->readerMock, $this->eventFacadeMock, $this->uuidGeneratorService);
    }

    /**
     * @return void
     */
    public function testCheckForExpiration(): void
    {
        $uuid = 'uuid';

        $this->readerMock->expects(static::atLeastOnce())
            ->method('getExpiredRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransferMock);

        $this->writerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->eventFacadeMock->expects(static::atLeastOnce())
            ->method('trigger');

        $this->manager->checkForExpiration($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testCheckForActivation(): void
    {
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
    public function testAddRepresentation(): void
    {
        $uuid = 'uuid';

        $this->uuidGeneratorService->expects(static::atLeastOnce())
            ->method('generateUuid5FromObjectId')
            ->willReturn($uuid);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('setUuid')
            ->with($uuid)
            ->willReturnSelf();

        $this->writerMock->expects(static::atLeastOnce())
            ->method('write')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->addRepresentation($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testFlagState(): void
    {
        $uuid = 'uuid';
        $state = 'state';

        $this->writerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->flagState($uuid, $state);
    }

    /**
     * @return void
     */
    public function testSetAllInProcess(): void
    {
        $uuid = 'uuid';

        $this->representativeCompanyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn([$this->representativeCompanyUserTransferMock]);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->writerMock->expects(static::atLeastOnce())
            ->method('flagState')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->manager->setAllInProcess($this->representativeCompanyUserCollectionTransferMock);
    }
}
