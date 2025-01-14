<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $id = 'id';

        $this->restAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceOriginator')
            ->willReturn($id);

        $this->permissionRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromAttributesTransfer')
            ->willReturn($this->representativeCompanyUserRestApiPermissionRequestTransferMock);

        $callCount = $this->atLeastOnce();
        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects($callCount)
            ->method('setPermissionKey')
            ->willReturnCallback(static function (string $key) use ($self, $callCount) {
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
                        $self->assertSame(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_OWN, $key);

                        return $self->representativeCompanyUserRestApiPermissionRequestTransferMock;
                    case 2:
                        $self->assertSame(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_GLOBAL, $key);

                        return $self->representativeCompanyUserRestApiPermissionRequestTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setOriginatorReference')
            ->with($id)
            ->willReturnSelf();

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageOwnRepresentations')
            ->willReturn(true);

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageGlobalRepresentations')
            ->willReturn(false);

        $this->permissionChecker->can($this->restAttributesTransferMock);
    }

    /**
     * @return void
     */
    public function testCanGlobal(): void
    {
        $self = $this;

        $id = 'id';
        $id2 = 'id2';

        $this->restAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceOriginator')
            ->willReturn($id);

        $this->permissionRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromAttributesTransfer')
            ->willReturn($this->representativeCompanyUserRestApiPermissionRequestTransferMock);

        $callCount = $this->atLeastOnce();
        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects($callCount)
            ->method('setPermissionKey')
            ->willReturnCallback(static function ($permissionKey) use ($self, $callCount) {
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
                        $self->assertSame(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_OWN, $permissionKey);

                        return $self->representativeCompanyUserRestApiPermissionRequestTransferMock;
                    case 2:
                        $self->assertSame(RepresentativeCompanyUserRestApiConstants::PERMISSION_KEY_GLOBAL, $permissionKey);

                        return $self->representativeCompanyUserRestApiPermissionRequestTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        $this->representativeCompanyUserRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setOriginatorReference')
            ->with($id)
            ->willReturnSelf();

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToManageGlobalRepresentations')
            ->willReturn(true);

        $this->permissionChecker->can($this->restAttributesTransferMock);
    }
}
