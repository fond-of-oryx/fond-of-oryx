<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class NotionProxyResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\Controller\NotionProxyResourceController
     */
    protected NotionProxyResourceController $controller;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory
     */
    protected MockObject|NotionProxyRestApiFactory $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface
     */
    protected MockObject|NotionProxyRequestCreatorInterface $notionProxyRequestCreatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer
     */
    protected MockObject|RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected MockObject|RestRequestInterface $restRequestMock;

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

        $this->factoryMock = $this->getMockBuilder(NotionProxyRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->notionProxyRequestCreatorMock = $this->getMockBuilder(NotionProxyRequestCreatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restNotionProxyRequestAttributesTransferMock = $this->getMockBuilder(RestNotionProxyRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends NotionProxyResourceController {
            /**
             * @var \FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory
             */
            protected $factoryMock;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiFactory $factory
             */
            public function __construct(NotionProxyRestApiFactory $factory)
            {
                $this->factoryMock = $factory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->factoryMock;
            }
        };
    }

    /**
     * @return void
     */
    public function testPostAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createNotionProxyRequestCreator')
            ->willReturn($this->notionProxyRequestCreatorMock);

        $this->notionProxyRequestCreatorMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->restNotionProxyRequestAttributesTransferMock, $this->restRequestMock)
            ->willReturn($this->restResponseMock);

        $restResponse = $this->controller->postAction(
            $this->restRequestMock,
            $this->restNotionProxyRequestAttributesTransferMock,
        );

        static::assertEquals($this->restResponseMock, $restResponse);
    }
}
