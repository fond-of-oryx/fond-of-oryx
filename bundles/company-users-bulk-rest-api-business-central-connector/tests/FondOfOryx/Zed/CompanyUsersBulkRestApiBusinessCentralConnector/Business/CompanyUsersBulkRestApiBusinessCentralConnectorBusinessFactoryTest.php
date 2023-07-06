<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Business\Expander\CompanyDebtorNumberExpander;
use FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence\CompanyUsersBulkRestApiBusinessCentralConnectorRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class CompanyUsersBulkRestApiBusinessCentralConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Container|MockObject $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence\CompanyUsersBulkRestApiBusinessCentralConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyUsersBulkRestApiBusinessCentralConnectorRepository|MockObject $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Business\CompanyUsersBulkRestApiBusinessCentralConnectorBusinessFactory
     */
    protected CompanyUsersBulkRestApiBusinessCentralConnectorBusinessFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this
            ->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(CompanyUsersBulkRestApiBusinessCentralConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new CompanyUsersBulkRestApiBusinessCentralConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateBulkManager(): void
    {
        static::assertInstanceOf(
            CompanyDebtorNumberExpander::class,
            $this->factory->createCompanyDebtorNumberExpander(),
        );
    }
}
