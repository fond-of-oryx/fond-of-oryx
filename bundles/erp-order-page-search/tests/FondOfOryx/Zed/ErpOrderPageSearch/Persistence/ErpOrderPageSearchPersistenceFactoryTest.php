<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapperInterface;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Spryker\Zed\Kernel\Container;

class ErpOrderPageSearchPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory;
     */
    protected $erpOrderPageSearchPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery
     */
    protected $erpOrderQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $fooErpOrderPageSearchQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderQueryMock = $this->getMockBuilder(ErpOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchPersistenceFactory = new ErpOrderPageSearchPersistenceFactory();
        $this->erpOrderPageSearchPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpOrderPageSearchMapper()
    {
        $this->assertInstanceOf(
            ErpOrderPageSearchMapperInterface::class,
            $this->erpOrderPageSearchPersistenceFactory->createErpOrderPageSearchMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpOrderQuery()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER)
            ->willReturn($this->erpOrderQueryMock);

        $this->assertInstanceOf(
            ErpOrderQuery::class,
            $this->erpOrderPageSearchPersistenceFactory->getErpOrderQuery(),
        );
    }
}
