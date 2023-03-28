<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface;
use FondOfOryx\Client\CompaniesRestApiPermission\Zed\CompaniesRestApiPermissionStub;
use Spryker\Client\Kernel\Container;

class CompaniesRestApiPermissionFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\CompaniesRestApiPermissionFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompaniesRestApiPermissionToZedRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompaniesRestApiPermissionFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompaniesRestApiPermissionStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompaniesRestApiPermissionDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompaniesRestApiPermissionStub::class,
            $this->factory->createCompaniesRestApiPermissionStub(),
        );
    }
}
