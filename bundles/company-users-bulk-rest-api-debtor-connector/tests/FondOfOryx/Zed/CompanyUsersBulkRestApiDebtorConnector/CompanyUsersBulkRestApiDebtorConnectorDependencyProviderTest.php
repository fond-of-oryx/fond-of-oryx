<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector;

use Codeception\Test\Unit;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanyUsersBulkRestApiDebtorConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiDebtorConnector\CompanyUsersBulkRestApiDebtorConnectorDependencyProvider
     */
    protected CompanyUsersBulkRestApiDebtorConnectorDependencyProvider $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->dependencyProvider = new CompanyUsersBulkRestApiDebtorConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $container = $this->dependencyProvider->providePersistenceLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);

        static::assertInstanceOf(
            SpyCompanyQuery::class,
            $container[CompanyUsersBulkRestApiDebtorConnectorDependencyProvider::QUERY_SPY_COMPANY],
        );
    }
}
