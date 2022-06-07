<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CartSearchResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Reader\CartReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Controller\CartSearchResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CartSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReaderMock = $this->getMockBuilder(CartReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends CartSearchResourceController {
            /**
             * @var \Spryker\Glue\Kernel\AbstractFactory
             */
            protected $abstractFactory;

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
            ->method('createCartReader')
            ->willReturn($this->companyReaderMock);

        $this->companyReaderMock->expects(static::atLeastOnce())
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
