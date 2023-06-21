<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Shared\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConstants;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

class PermissionCheckerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer
     */
    protected $representativeCompanyUserRestApiPermissionRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer
     */
    protected $restAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
     */
    protected $permissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $permissionRequestMapperMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionChecker
     */
    protected $permissionChecker;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restAttributesTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionRequestMapperMock = $this->getMockBuilder(PermissionRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionChecker = new PermissionChecker(
            $this->permissionClientMock,
            $this->permissionRequestMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testCanOwn(): void
    {
        $id = 'id';

        $this->restAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceOriginator')
            ->willReturn($id);

        $this->permissionRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromAttributesTransfer')
            ->willReturn($this->representativeCompanyUserRestApiPermissionRequestTransferMock);

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setPermissionKey')
            ->with(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_OWN)
            ->willReturnSelf();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setOriginatorReference')
            ->with($id)
            ->willReturnSelf();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getDistributorReference')
            ->willReturn($id);

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageOwnRepresentations')
            ->willReturn(true);

        $this->permissionChecker->can($this->restAttributesTransferMock);
    }

    /**
     * @return void
     */
    public function testCanGlobal(): void
    {
        $id = 'id';
        $id2 = 'id2';

        $this->restAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceOriginator')
            ->willReturn($id);

        $this->permissionRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromAttributesTransfer')
            ->willReturn($this->representativeCompanyUserRestApiPermissionRequestTransferMock);

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setPermissionKey')
            ->withConsecutive(
                [RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_OWN],
                [RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_GLOBAL],
            )
            ->willReturnSelf();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setOriginatorReference')
            ->with($id)
            ->willReturnSelf();

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('getDistributorReference')
            ->willReturn($id2);

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageGlobalRepresentations')
            ->willReturn(true);

        $this->permissionChecker->can($this->restAttributesTransferMock);
    }
}
