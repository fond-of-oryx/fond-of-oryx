<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReaderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class OrderBudgetSearchResourceControllerTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiFactory|MockObject $factoryMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetReaderInterface|MockObject $orderBudgetReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Controller\OrderBudgetSearchResourceController
     */
    protected OrderBudgetSearchResourceController $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(OrderBudgetSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReaderMock = $this->getMockBuilder(OrderBudgetReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends OrderBudgetSearchResourceController {
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
            ->method('createOrderBudgetReader')
            ->willReturn($this->orderBudgetReaderMock);

        $this->orderBudgetReaderMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->controller->getAction(
                $this->restRequestMock,
            ),
        );
    }
}
