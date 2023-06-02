<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed\RepresentativeCompanyUserTradeFairRestApiPermissionStub;
use Spryker\Client\Kernel\Container;

class RepresentativeCompanyUserTradeFairRestApiPermissionFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected MockObject|Container $containerMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\RepresentativeCompanyUserTradeFairRestApiPermissionFactory
     */
    protected RepresentativeCompanyUserTradeFairRestApiPermissionFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new RepresentativeCompanyUserTradeFairRestApiPermissionFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedRepresentativeCompanyUserTradeFairRestApiPermissionStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(RepresentativeCompanyUserTradeFairRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            RepresentativeCompanyUserTradeFairRestApiPermissionStub::class,
            $this->factory->createRepresentativeCompanyUserTradeFairRestApiPermissionStub()
        );
    }
}
