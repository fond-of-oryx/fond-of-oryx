<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiFactory;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyRoleSearchResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Controller\CompanyUserSearchResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyRoleSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleReaderMock = $this->getMockBuilder(CompanyRoleReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends CompanyRoleSearchResourceController {
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
            ->method('createCompanyRoleReader')
            ->willReturn($this->companyRoleReaderMock);

        $this->companyRoleReaderMock->expects(static::atLeastOnce())
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
