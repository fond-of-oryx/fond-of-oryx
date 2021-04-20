<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapperInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Container;

class ReturnLabelPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressQueryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelPersistenceFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyUnitAddressQueryMock = $this->getMockBuilder(SpyCompanyUnitAddressQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelPersistenceFactory();
        $this->factory->setConfig($this->configMock);
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function getCompanyUnitAddressQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS])
            ->willReturnOnConsecutiveCalls($this->spyCompanyUnitAddressQueryMock);

        static::assertEquals(
            $this->spyCompanyUnitAddressQueryMock,
            $this->factory->getCompanyUnitAddressQuery()
        );
    }

    /**
     * @return void
     */
    public function createCompanyUnitAddressMapper(): void
    {
        static::assertInstanceOf(
            CompanyUnitAddressMapperInterface::class,
            $this->factory->createCompanyUnitAddressMapper()
        );
    }
}
