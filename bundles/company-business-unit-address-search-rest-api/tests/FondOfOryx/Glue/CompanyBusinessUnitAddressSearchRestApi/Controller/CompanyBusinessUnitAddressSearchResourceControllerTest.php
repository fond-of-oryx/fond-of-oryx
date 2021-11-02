<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyBusinessUnitAddressSearchResourceControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitAddressListReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Controller\CompanyBusinessUnitAddressSearchResourceController
     */
    protected $controller;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListReaderMock = $this->getMockBuilder(CompanyBusinessUnitAddressReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new class ($this->factoryMock) extends CompanyBusinessUnitAddressSearchResourceController {
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
            ->method('createCompanyBusinessUnitAddressReader')
            ->willReturn($this->companyBusinessUnitAddressListReaderMock);

        $this->companyBusinessUnitAddressListReaderMock->expects(static::atLeastOnce())
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
