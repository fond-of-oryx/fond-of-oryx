<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiFactory;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class RepresentativeCompanyUserTradeFairResourceControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiFactory
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiFactory $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager\TradeFairRepresentationManagerInterface
     */
    protected MockObject|TradeFairRepresentationManagerInterface $tradeFairRepresentationManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tradeFairRepresentationManagerMock = $this->getMockBuilder(TradeFairRepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceController = new class ($this->factoryMock) extends RepresentativeCompanyUserTradeFairResourceController {
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
    public function testAddAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->addAction($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->getAction($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testPatchAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('patch')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->patchAction($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteAction(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->resourceController->deleteAction($this->restRequestMock),
        );
    }
}
