<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;

class RepresentationManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Dependency\Facade\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRepresentativeCompanyUserRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Business\Model\RepresentationManagerInterface
     */
    protected $representationManager;

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

        $this->restRepresentativeCompanyUserAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserAttributesTransfer::class)
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
            $restRepresentativeCompanyUserResponseTransfer->getRepresentation(),
            $this->representativeCompanyUserTransferMock,
        );
    }
}
