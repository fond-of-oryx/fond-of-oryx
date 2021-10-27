<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed\CompanyBusinessUnitSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CompanyBusinessUnitSearchRestApiFactoryTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyBusinessUnitSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanyBusinessUnitSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyBusinessUnitSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompanyBusinessUnitSearchRestApiStub::class,
            $this->factory
                ->createZedCompanyBusinessUnitSearchRestApiStub()
        );
    }
}
