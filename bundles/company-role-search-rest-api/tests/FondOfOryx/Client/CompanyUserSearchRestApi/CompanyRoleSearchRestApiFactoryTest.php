<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CompanyRoleSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyRoleSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyRoleSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanyRoleSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyRoleSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompanyRoleSearchRestApiStub::class,
            $this->factory
                ->createZedCompanyRoleSearchRestApiStub(),
        );
    }
}
