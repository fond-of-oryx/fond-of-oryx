<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Shared\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConstants;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class TradeFairRepresentationManagerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiClientInterface $representativeCompanyUserTradeFairRestApiClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected MockObject|RepresentationMapperInterface $representationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected MockObject|RestResponseBuilderInterface $responseBuilderMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface
     */
    protected TradeFairRepresentationManagerInterface $tradeFairRepresentationManager;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected MockObject|RestResponseBuilderInterface $restRepresentativeCompanyUserTradeFairAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairResponseTransfer $restRepresentativeCompanyUserTradeFairResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected MockObject|RestResponseInterface $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairCollectionTransfer $representativeCompanyUserTradeFairCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->representativeCompanyUserTradeFairRestApiClientMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationMapperMock = $this
            ->getMockBuilder(RepresentationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseBuilderMock = $this
            ->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this
            ->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this
            ->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tradeFairRepresentationManager = new TradeFairRepresentationManager(
            $this->representativeCompanyUserTradeFairRestApiClientMock,
            $this->representationMapperMock,
            $this->responseBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('addTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserTradeFairRestResponse')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager
            ->add($this->restRequestMock);

        static::assertEquals(
            $this->restResponseMock,
            $response,
        );
    }

    /**
     * @return void
     */
    public function testAddWithError(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('addTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn('error');

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestErrorResponse')
            ->with('error', RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager
            ->add($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
        static::assertIsArray($response->getErrors());
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('getTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCollection')
            ->willReturn($this->representativeCompanyUserTradeFairCollectionTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserTradeFairCollectionRestResponse')
            ->with($this->representativeCompanyUserTradeFairCollectionTransferMock)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->get($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
    }

    /**
     * @return void
     */
    public function testGetWithError(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('getTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn('error');

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestErrorResponse')
            ->with('error', RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->get($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
        static::assertIsArray($response->getErrors());
    }

    /**
     * @return void
     */
    public function testPatch(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('patchTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserTradeFairRestResponse')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->patch($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
    }

    /**
     * @return void
     */
    public function testPatchWithError(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('patchTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn('error');

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestErrorResponse')
            ->with('error', RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->patch($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
        static::assertIsArray($response->getErrors());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('deleteTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn(null);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getRepresentation')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRepresentativeCompanyUserTradeFairRestResponse')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->delete($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
    }

    /**
     * @return void
     */
    public function testDeleteWithError(): void
    {
        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createAttributesFromRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->representationMapperMock->expects(static::atLeastOnce())
            ->method('createRequest')
            ->with(
                $this->restRequestMock,
                $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock,
            )
            ->willReturn($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->representativeCompanyUserTradeFairRestApiClientMock->expects(static::atLeastOnce())
            ->method('deleteTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock->expects(static::atLeastOnce())
            ->method('getError')
            ->willReturn('error');

        $this->responseBuilderMock->expects(static::atLeastOnce())
            ->method('createRestErrorResponse')
            ->with('error', RepresentativeCompanyUserTradeFairRestApiConstants::HTTP_CODE_VALIDATION_ERRORS)
            ->willReturn($this->restResponseMock);

        $response = $this->tradeFairRepresentationManager->delete($this->restRequestMock);

        static::assertEquals($this->restResponseMock, $response);
        static::assertIsArray($response->getErrors());
    }
}
