<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiFactory;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompaniesResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\CompaniesRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $deleterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Controller\CompaniesResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompaniesRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleterMock = $this->getMockBuilder(CompanyDeleterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends CompaniesResourceController {
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
    public function testDeleteAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyDeleter')
            ->willReturn($this->deleterMock);

        $this->deleterMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->controller->deleteAction(
                $this->restRequestMock,
            ),
        );
    }
}
