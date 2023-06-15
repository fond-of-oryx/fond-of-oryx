<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairCollectionTransfer $representativeCompanyUserTradeFairCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $restResponseBuilder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected MockObject|RestResponseInterface $restResponseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this
            ->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this
            ->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this
            ->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder($this->restResourceBuilderMock);
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserTradeFairRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
                null,
                $this->representativeCompanyUserTradeFairTransferMock,
            )
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        $response = $this->restResponseBuilder
            ->buildRepresentativeCompanyUserTradeFairRestResponse($this->representativeCompanyUserTradeFairTransferMock);

        static::assertEquals(
            $this->restResponseMock,
            $response,
        );
    }

    /**
     * @return void
     */
    public function testBuildRepresentativeCompanyUserTradeFairCollectionRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
                null,
                $this->representativeCompanyUserTradeFairCollectionTransferMock,
            )
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        $response = $this->restResponseBuilder
            ->buildRepresentativeCompanyUserTradeFairCollectionRestResponse($this->representativeCompanyUserTradeFairCollectionTransferMock);

        static::assertEquals(
            $this->restResponseMock,
            $response,
        );
    }

    /**
     * @return void
     */
    public function testCreateRestErrorResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->willReturnSelf();

        $response = $this->restResponseBuilder
            ->createRestErrorResponse('', 1);

        static::assertEquals($this->restResponseMock, $response);
        static::assertEquals(0, $response->getStatus());
        static::assertIsArray($response->getErrors());
    }
}
