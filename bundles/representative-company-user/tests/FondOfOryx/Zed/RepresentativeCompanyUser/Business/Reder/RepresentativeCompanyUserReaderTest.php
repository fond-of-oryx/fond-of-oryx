<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserCollectionTransfer;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReader
     */
    protected $reader;

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

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserCollectionTransfer = $this->getMockBuilder(RepresentativeCompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new RepresentativeCompanyUserReader($this->repositoryMock, $this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testGetAndFlagInProcessNewRepresentativeCompanyUser(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('findAndFlagInProcessNewRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransfer);

        $this->reader->getAndFlagInProcessNewRepresentativeCompanyUser($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testGetRepresentativeCompanyUserByState(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findRepresentativeCompanyUserByState')
            ->willReturn($this->representativeCompanyUserCollectionTransfer);

        $this->reader->getRepresentativeCompanyUserByState('new');
    }

    /**
     * @return void
     */
    public function testGetAllCompanyUserByCustomerId(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getAllCompanyUserByCustomerId')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->reader->getAllCompanyUserByCustomerId(1);
    }

    /**
     * @return void
     */
    public function testGetAllCompanyUserByFkRepresentativeCompanyUser(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findCompanyUserByIdRepresentativeCompanyUser')
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->reader->getAllCompanyUserByFkRepresentativeCompanyUser(1);
    }

    /**
     * @return void
     */
    public function testGetExpiredRepresentativeCompanyUser(): void
    {
        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findExpiredRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserCollectionTransfer);

        $this->reader->getExpiredRepresentativeCompanyUser($this->filterTransferMock);
    }
}
