<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed\CompanyBusinessUnitAddressSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CompanyBusinessUnitAddressSearchRestApiFactoryTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyBusinessUnitAddressSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanyBusinessUnitAddressSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyBusinessUnitAddressSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompanyBusinessUnitAddressSearchRestApiStub::class,
            $this->factory
                ->createZedCompanyBusinessUnitAddressSearchRestApiStub()
        );
    }
}
