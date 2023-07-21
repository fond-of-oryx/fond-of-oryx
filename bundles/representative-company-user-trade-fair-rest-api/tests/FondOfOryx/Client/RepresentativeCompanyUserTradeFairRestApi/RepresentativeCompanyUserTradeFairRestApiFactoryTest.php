<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Zed\RepresentativeCompanyUserTradeFairRestApiStub;
use Spryker\Client\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserTradeFairRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedRepresentativeCompanyUserTradeFairRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserTradeFairRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairRestApiStub::class,
            $this->factory->createZedRepresentativeCompanyUserTradeFairRestApiStub(),
        );
    }
}
