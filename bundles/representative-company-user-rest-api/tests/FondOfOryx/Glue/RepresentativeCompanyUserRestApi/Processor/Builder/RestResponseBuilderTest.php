<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected RestResourceBuilderInterface|MockObject $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserResponseTransfer|MockObject $restRepresentativeCompanyUserResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserTransfer|MockObject $representativeCompanyUserTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserCollectionResponseTransfer|MockObject $restRepresentativeCompanyUserCollectionResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected RestResourceInterface|MockObject $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilder
     */
    protected RestResponseBuilder $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserCollectionResponseTransferMock = $this->getMockBuilder(RestRepresentativeCompanyUserCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRepresentativeCompanyUserResponseTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn(null);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API,
                null,
                $this->restRepresentativeCompanyUserResponseTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildRepresentativeCompanyUserRestResponse(
                $this->restRepresentativeCompanyUserResponseTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserRestResponseAndSetUuid(): void
    {
        $uuid = '12345';

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRepresentativeCompanyUserResponseTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn($this->representativeCompanyUserTransferMock);

        $this->representativeCompanyUserTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API,
                $uuid,
                $this->restRepresentativeCompanyUserResponseTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildRepresentativeCompanyUserRestResponse(
                $this->restRepresentativeCompanyUserResponseTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserCollectionRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API,
                null,
                $this->restRepresentativeCompanyUserCollectionResponseTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildRepresentativeCompanyUserCollectionRestResponse(
                $this->restRepresentativeCompanyUserCollectionResponseTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserMissingPermissionResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        static::assertTrue($restErrorMessageTransfer->getCode() === (string)RepresentativeCompanyUserRestApiConfig::RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION);
                        static::assertTrue($restErrorMessageTransfer->getDetail() === RepresentativeCompanyUserRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION);
                        static::assertTrue($restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN);

                        return true;
                    },
                ),
            )->willReturn($this->restResponseMock);

        $this->restResponseBuilder->buildErrorResponse();
    }
}
