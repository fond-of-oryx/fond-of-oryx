<?php

namespace FondOfOryx\Client\CompanySearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanySearchRestApi\Zed\CompanySearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CompanySearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container|mixed
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompanySearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanySearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanySearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanySearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompanySearchRestApiStub::class,
            $this->factory
                ->createZedCompanySearchRestApiStub(),
        );
    }
}
