<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiConfig;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $builder;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    protected MockObject|RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected MockObject|RestResourceBuilderInterface $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected MockObject|RestResponseInterface $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restNotionProxyRequestResponseTransferMock = $this->getMockBuilder(RestNotionProxyRequestResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->builder = new RestResponseBuilder($this->restResourceBuilderMock);
    }

    /**
     * @return void
     */
    public function testBuildRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturnSelf();

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                NotionProxyRestApiConfig::RESOURCE_NOTION_PROXY,
                null,
                $this->restNotionProxyRequestResponseTransferMock,
            )
            ->willReturn($this->restResourceMock);

        $restResponse = $this->builder->buildRestResponse($this->restNotionProxyRequestResponseTransferMock);

        static::assertEquals($this->restResponseMock, $restResponse);
    }
}
