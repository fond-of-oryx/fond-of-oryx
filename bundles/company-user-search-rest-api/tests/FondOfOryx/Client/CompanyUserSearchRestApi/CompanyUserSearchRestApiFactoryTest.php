<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\CompanyUserSearchRestApi\Zed\CompanyUserSearchRestApiStub;
use Spryker\Client\Kernel\Container;

class CompanyUserSearchRestApiFactoryTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiFactory
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

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyUserSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUserSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedCompanyUserSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyUserSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            CompanyUserSearchRestApiStub::class,
            $this->factory
                ->createZedCompanyUserSearchRestApiStub()
        );
    }
}
