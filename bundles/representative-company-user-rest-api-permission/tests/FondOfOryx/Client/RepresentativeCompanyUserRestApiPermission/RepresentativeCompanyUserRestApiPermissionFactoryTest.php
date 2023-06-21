<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed\RepresentativeCompanyUserRestApiPermissionStub;
use Spryker\Client\Kernel\Container;

class RepresentativeCompanyUserRestApiPermissionFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\RepresentativeCompanyUserRestApiPermissionFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserRestApiPermissionFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedRepresentativeCompanyUserRestApiPermissionStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            RepresentativeCompanyUserRestApiPermissionStub::class,
            $this->factory->createRepresentativeCompanyUserRestApiPermissionStub(),
        );
    }
}
