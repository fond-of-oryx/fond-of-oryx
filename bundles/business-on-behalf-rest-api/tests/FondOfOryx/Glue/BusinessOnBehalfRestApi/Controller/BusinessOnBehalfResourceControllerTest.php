<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessorInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class BusinessOnBehalfResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|BusinessOnBehalfProcessorInterface $businessOnBehalfProcessorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Controller\BusinessOnBehalfResourceController
     */
    protected BusinessOnBehalfResourceController $resourceController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(BusinessOnBehalfRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessOnBehalfProcessorMock = $this->getMockBuilder(BusinessOnBehalfProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestAttributesTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceController = new class ($this->factoryMock) extends BusinessOnBehalfResourceController {
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
    public function testPostAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createBusinessOnBehalfProcessor')
            ->willReturn($this->businessOnBehalfProcessorMock);

        $this->businessOnBehalfProcessorMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUser')
            ->with($this->restRequestMock, $this->restBusinessOnBehalfRequestAttributesTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->postAction(
                $this->restRequestMock,
                $this->restBusinessOnBehalfRequestAttributesTransferMock,
            ),
        );
    }
}
