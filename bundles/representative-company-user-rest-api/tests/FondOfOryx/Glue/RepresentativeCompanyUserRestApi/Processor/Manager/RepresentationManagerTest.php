<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClientInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class RepresentationManagerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClientInterface
     */
    protected MockObject|RepresentativeCompanyUserRestApiClientInterface $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected MockObject|RepresentationMapperInterface $representationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected MockObject|RestResponseBuilderInterface $responseBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface
     */
    protected MockObject|PermissionCheckerInterface $permissionCheckerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserAttributesTransfer $restRepresentativeCompanyUserAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserRequestTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserRequestTransfer $restRepresentativeCompanyUserRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserCollectionResponseTransfer $restRepresentativeCompanyUserCollectionResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected MockObject|RestResponseInterface $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected MockObject|RestUserTransfer $restUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected MockObject|Request $requestMock;

    /**
     * @var \Symfony\Component\HttpFoundation\InputBag
     */
    protected InputBag $inputBagMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManagerInterface
     */
    protected RepresentationManagerInterface $representationManager;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationMapperMock = $this->getMockBuilder(RepresentationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionCheckerMock = $this->getMockBuilder(PermissionCheckerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this
            ->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserAttributesTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserRequestTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserCollectionResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationManager = new RepresentationManager(
            $this->clientMock,
            $this->representationMapperMock,
            $this->responseBuilderMock,
            $this->permissionCheckerMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->willReturn($this->restRepresentativeCompanyUserAttributesTransferMock);

        $this->restRepresentativeCompanyUserAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getReferenceRepresentations')
            ->willReturn([]);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->willReturn($this->restRepresentativeCompanyUserRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('addRepresentation')
            ->willReturn($this->restRepresentativeCompanyUserResponseTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserRestResponse')
            ->willReturn($this->restResponseMock);

        $this->responseBuilderMock->expects(static::never())
            ->method('buildErrorResponse');

        $this->representationManager->add($this->restRequestMock);
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->willReturn($this->restRepresentativeCompanyUserAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->willReturn($this->restRepresentativeCompanyUserRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn($this->restRepresentativeCompanyUserCollectionResponseTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserCollectionRestResponse')
            ->willReturn($this->restResponseMock);

        $this->responseBuilderMock->expects(static::never())
            ->method('buildErrorResponse');

        $this->representationManager->get($this->restRequestMock);
    }

    /**
     * @return void
     */
    public function testPatch(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->willReturn($this->restRepresentativeCompanyUserAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->willReturn($this->restRepresentativeCompanyUserRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('patchRepresentation')
            ->willReturn($this->restRepresentativeCompanyUserResponseTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserRestResponse')
            ->willReturn($this->restResponseMock);

        $this->responseBuilderMock->expects(static::never())
            ->method('buildErrorResponse');

        $this->representationManager->patch($this->restRequestMock);
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->willReturn($this->restRepresentativeCompanyUserAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->willReturn($this->restRepresentativeCompanyUserRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('deleteRepresentation')
            ->willReturn($this->restRepresentativeCompanyUserResponseTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserRestResponse')
            ->willReturn($this->restResponseMock);

        $this->responseBuilderMock->expects(static::never())
            ->method('buildErrorResponse');

        $this->representationManager->delete($this->restRequestMock);
    }
}
