<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface;
use FondOfOryx\Client\RepresentativeCompanyUserRestApi\Zed\RepresentativeCompanyUserRestApiStub;
use Spryker\Client\Kernel\Container;

class RepresentativeCompanyUserRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\Dependency\Client\RepresentativeCompanyUserRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedRepresentativeCompanyUserRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            RepresentativeCompanyUserRestApiStub::class,
            $this->factory->createZedRepresentativeCompanyUserRestApiStub(),
        );
    }
}
