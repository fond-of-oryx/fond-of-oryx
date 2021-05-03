<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressQueryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory
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

        $this->spyCompanyUnitAddressQueryMock = $this->getMockBuilder(SpyCompanyUnitAddressQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiPersistenceFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressQuery(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([ReturnLabelsRestApiDependencyProvider::PROPEL_QUERY_COMPANY_UNIT_ADDRESS])
            ->willReturnOnConsecutiveCalls($this->spyCompanyUnitAddressQueryMock);

        static::assertInstanceOf(
            SpyCompanyUnitAddressQuery::class,
            $this->factory->getCompanyUnitAddressQuery()
        );
    }
}
