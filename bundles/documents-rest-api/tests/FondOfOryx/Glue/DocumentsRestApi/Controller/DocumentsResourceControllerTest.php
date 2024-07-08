<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiFactory;
use FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReaderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class DocumentsResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected DocumentsRestApiFactory|MockObject $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\DocumentsRestApi\Processor\Reader\DocumentReaderInterface
     */
    protected MockObject|DocumentReaderInterface $documentReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Controller\DocumentsResourceController
     */
    protected DocumentsResourceController $resourceController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(DocumentsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentReaderMock = $this->getMockBuilder(DocumentReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceController = new class ($this->factoryMock) extends DocumentsResourceController {
            /**
             * @var \Spryker\Glue\Kernel\AbstractFactory
             */
            protected AbstractFactory $abstractFactory;

            /**
             * @param \Spryker\Glue\Kernel\AbstractFactory $abstractFactory
             */
            public function __construct(AbstractFactory $abstractFactory)
            {
                $this->abstractFactory = $abstractFactory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            protected function getFactory(): AbstractFactory
            {
                return $this->abstractFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createDocumentReader')
            ->willReturn($this->documentReaderMock);

        $this->documentReaderMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->getAction(
                $this->restRequestMock,
            ),
        );
    }
}
