<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RepresentationManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|MockObject $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserRestApiRepository|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\Mapper\RestDataMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestDataMapperInterface|MockObject $restDataMapperMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserTransfer|MockObject $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserAttributesTransfer|MockObject $restRepresentativeCompanyUserAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserResponseTransfer|MockObject $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserRequestTransfer|MockObject $restRepresentativeCompanyUserRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserTransfer|MockObject $restRepresentativeCompanyUserTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface
     */
    protected RepresentationManagerInterface $representationManager;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(RepresentativeCompanyUserRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restDataMapperMock = $this
            ->getMockBuilder(RestDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationManager = new RepresentationManager(
            $this->facadeMock,
            $this->repositoryMock,
            $this->restDataMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testAddRepresentation(): void
    {
        $distributerReference = 'distributer-reference';
        $distributerId = 1;

        $representationReference = 'representation-reference';
        $representationId = 1;

        $originatorReference = 'originator-reference';

        $startAt = '01-01-1970';
        $endAt = '02-01-1970';

        $this->restRepresentativeCompanyUserRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserAttributesTransferMock);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceDistributor')
            ->willReturn($distributerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByReference')
            ->willReturn($distributerId);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceRepresentation')
            ->willReturn($representationReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByReference')
            ->willReturn($distributerId);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceDistributor')
            ->willReturn($representationId);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceOriginator')
            ->willReturn($originatorReference);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($startAt);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn($endAt);

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('addRepresentativeCompanyUser')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->restDataMapperMock->expects(static::atLeastOnce())
            ->method('mapResponse')
            ->willReturn($this->restRepresentativeCompanyUserTransferMock);

        $restRepresentativeCompanyUserResponseTransfer = $this->representationManager
            ->addRepresentation($this->restRepresentativeCompanyUserRequestTransferMock);

        static::assertInstanceOf(
            RestRepresentativeCompanyUserResponseTransfer::class,
            $restRepresentativeCompanyUserResponseTransfer,
        );

        static::assertEquals(
            $restRepresentativeCompanyUserResponseTransfer->getRequest(),
            $this->restRepresentativeCompanyUserRequestTransferMock,
        );

        static::assertEquals(
            $restRepresentativeCompanyUserResponseTransfer->getRepresentations()[0],
            $this->restRepresentativeCompanyUserTransferMock,
        );
    }
}
