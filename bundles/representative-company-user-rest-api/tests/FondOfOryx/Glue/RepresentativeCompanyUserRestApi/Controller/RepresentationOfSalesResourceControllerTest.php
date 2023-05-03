<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class RepresentationOfSalesResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager\RepresentationManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $managerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Controller\RepresentativeCompanyUserResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->managerMock = $this->getMockBuilder(RepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends RepresentativeCompanyUserResourceController {
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
    public function testAddAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRepresentationManager')
            ->willReturn($this->managerMock);

        $this->managerMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->controller->addAction(
                $this->restRequestMock,
            ),
        );
    }
}
