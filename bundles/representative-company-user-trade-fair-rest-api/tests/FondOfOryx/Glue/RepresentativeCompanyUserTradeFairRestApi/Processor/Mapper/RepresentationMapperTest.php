<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\Request;

class RepresentationMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface
     */
    protected MockObject|MetadataInterface $metadataMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransferMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected RepresentationMapperInterface $representationMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected MockObject|RestUserTransfer $restUserTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->metadataMock = $this
            ->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this
            ->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this
            ->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this
            ->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationMapper = new RepresentationMapper();
    }

    /**
     * @return void
     */
    public function testCreateRequest(): void
    {
        $restRepresentativeCompanyUserTradeFairRequestTransfer = $this->representationMapper
            ->createRequest($this->restRequestMock, $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        static::assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairRequestTransfer::class,
            $restRepresentativeCompanyUserTradeFairRequestTransfer,
        );

        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRequestWithNullAttributes(): void
    {
        $uuid = 'uuid';
        $naturalIdentifier = 'natural-identifier';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getAttributesDataFromRequest')
            ->willReturn([]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn(Request::METHOD_GET);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($uuid);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($naturalIdentifier);

        $restRepresentativeCompanyUserTradeFairRequestTransfer = $this->representationMapper
            ->createRequest($this->restRequestMock, null);

        static::assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairRequestTransfer::class,
            $restRepresentativeCompanyUserTradeFairRequestTransfer,
        );

        static::assertEquals(
            $uuid,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getUuid(),
        );

        static::assertEquals(
            $naturalIdentifier,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getCustomerReferenceOriginator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRequestWithNullDataAttributes(): void
    {
        $uuid = 'uuid';
        $naturalIdentifier = 'natural-identifier';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getAttributesDataFromRequest')
            ->willReturn(null);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn(Request::METHOD_GET);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($uuid);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($naturalIdentifier);

        $restRepresentativeCompanyUserTradeFairRequestTransfer = $this->representationMapper
            ->createRequest($this->restRequestMock, null);

        static::assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairRequestTransfer::class,
            $restRepresentativeCompanyUserTradeFairRequestTransfer,
        );

        static::assertEquals(
            $uuid,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getUuid(),
        );

        static::assertEquals(
            $naturalIdentifier,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getCustomerReferenceOriginator(),
        );
    }

    /**
     * @return void
     */
    public function testCreateRequestWithNullUuid(): void
    {
        $naturalIdentifier = 'natural-identifier';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getAttributesDataFromRequest')
            ->willReturn(null);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn('');

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($naturalIdentifier);

        $restRepresentativeCompanyUserTradeFairRequestTransfer = $this->representationMapper
            ->createRequest($this->restRequestMock, null);

        static::assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairRequestTransfer::class,
            $restRepresentativeCompanyUserTradeFairRequestTransfer,
        );

        static::assertNull(
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getUuid(),
        );

        static::assertEquals(
            $naturalIdentifier,
            $restRepresentativeCompanyUserTradeFairRequestTransfer->getAttributes()->getCustomerReferenceOriginator(),
        );
    }
}
