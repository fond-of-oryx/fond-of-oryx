<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessor;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiFactory;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequest;
use Spryker\Glue\Kernel\AbstractFactory;

class ReturnLabelsRestApiResourceControllerTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestAttributesTransfer;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelProcessorMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponse|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Controller\ReturnLabelsRestApiResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestAttributesTransfer = $this->getMockBuilder(RestReturnLabelRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelProcessorMock = $this->getMockBuilder(ReturnLabelProcessor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends ReturnLabelsRestApiResourceController {
            /**
             * @var \Spryker\Glue\Kernel\AbstractFactory
             */
            protected $factory;

            /**
             *  constructor.
             *
             * @param \Spryker\Glue\Kernel\AbstractFactory $factory
             */
            public function __construct(AbstractFactory $factory)
            {
                $this->factory = $factory;
            }

            /**
             * @return \Spryker\Glue\Kernel\AbstractFactory
             */
            public function getFactory(): AbstractFactory
            {
                return $this->factory;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createReturnLabelProcessor')
            ->willReturn($this->returnLabelProcessorMock);

        $this->returnLabelProcessorMock->expects(static::atLeastOnce())
            ->method('getReturnLabel')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        $restResponse = $this->controller->getAction($this->restRequestMock);

        static::assertEquals(
            $this->restResponseMock,
            $restResponse
        );
    }
}
