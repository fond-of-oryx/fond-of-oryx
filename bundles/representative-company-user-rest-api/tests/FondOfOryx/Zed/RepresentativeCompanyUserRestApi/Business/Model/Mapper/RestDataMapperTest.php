<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Laminas\Stdlib\ArrayObject;
use PHPUnit\Framework\MockObject\MockObject;

class RestDataMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserTransfer|MockObject $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserCollectionTransfer|MockObject $representativeCompanyUserCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerTransfer|MockObject $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapper
     */
    protected RestDataMapper $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->representativeCompanyUserTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserCollectionTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new RestDataMapper();
    }

    /**
     * @return void
     */
    public function testMapResponse(): void
    {
        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getDistributor')
            ->willReturn($this->customerTransferMock);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getRepresentative')
            ->willReturn($this->customerTransferMock);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getOriginator')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock
            ->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->mapper->mapResponse($this->representativeCompanyUserTransferMock);
    }

    /**
     * @return void
     */
    public function testMapResponseCollection(): void
    {
        $this->representativeCompanyUserCollectionTransferMock
            ->expects(static::atLeastOnce())
            ->method('getRepresentations')
            ->willReturn(new ArrayObject([$this->representativeCompanyUserTransferMock]));

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getDistributor')
            ->willReturn($this->customerTransferMock);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getRepresentative')
            ->willReturn($this->customerTransferMock);

        $this->representativeCompanyUserTransferMock
            ->expects(static::atLeastOnce())
            ->method('getOriginator')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock
            ->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->mapper->mapResponseCollection($this->representativeCompanyUserCollectionTransferMock);
    }
}
