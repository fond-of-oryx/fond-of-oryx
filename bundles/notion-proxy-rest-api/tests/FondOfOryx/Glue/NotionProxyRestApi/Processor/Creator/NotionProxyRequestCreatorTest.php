<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator;

use Codeception\Test\Unit;
use FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClient;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class NotionProxyRequestCreatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface
     */
    protected NotionProxyRequestCreatorInterface $creator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClient
     */
    protected MockObject|NotionProxyRestApiClient $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected MockObject|RestResponseBuilderInterface $restResponseBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected MockObject|RestResponseInterface $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer
     */
    protected MockObject|RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer
     */
    protected MockObject|RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(NotionProxyRestApiClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restNotionProxyRequestAttributesTransferMock = $this->getMockBuilder(RestNotionProxyRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restNotionProxyRequestResponseTransferMock = $this->getMockBuilder(RestNotionProxyRequestResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creator = new NotionProxyRequestCreator(
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->with($this->restNotionProxyRequestAttributesTransferMock)
            ->willReturn($this->restNotionProxyRequestResponseTransferMock);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildRestResponse')
            ->with($this->restNotionProxyRequestResponseTransferMock)
            ->willReturn($this->restResponseMock);

        $restResponse = $this->creator->create(
            $this->restNotionProxyRequestAttributesTransferMock,
            $this->restRequestMock,
        );

        static::assertEquals($this->restResponseMock, $restResponse);
    }
}
