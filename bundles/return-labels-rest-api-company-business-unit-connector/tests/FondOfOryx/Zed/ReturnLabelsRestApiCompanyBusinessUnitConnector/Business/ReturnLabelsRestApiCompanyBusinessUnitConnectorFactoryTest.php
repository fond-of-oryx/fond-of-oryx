<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpander;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository;

class ReturnLabelsRestApiCompanyBusinessUnitConnectorFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this
            ->getMockBuilder(ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiCompanyBusinessUnitConnectorFactory();
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBusinessUnitExpander(): void
    {
        static::assertInstanceOf(
            CompanyBusinessUnitExpander::class,
            $this->factory->createCompanyBusinessUnitExpander(),
        );
    }
}
