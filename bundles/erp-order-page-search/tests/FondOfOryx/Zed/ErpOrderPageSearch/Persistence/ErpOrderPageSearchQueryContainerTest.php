<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;

class ErpOrderPageSearchQueryContainerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $erpOrderQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer
     */
    protected $erpOrderPageSearchPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface
     */
    protected $erpOrderPageSearchQueryContainer;

    /**
     * @var array<int>
     */
    protected $erpOrderIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderQueryMock = $this->getMockBuilder(ErpOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchPersistenceFactoryMock = $this->getMockBuilder(ErpOrderPageSearchPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderIds = [1];

        $this->erpOrderPageSearchQueryContainer = new ErpOrderPageSearchQueryContainer();
        $this->erpOrderPageSearchQueryContainer->setFactory($this->erpOrderPageSearchPersistenceFactoryMock);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testQueryErpOrdersByErpOrderIds(): void
    {
        $this->erpOrderPageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpOrderQuery')
            ->willReturn($this->erpOrderQueryMock);

        $this->erpOrderQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpOrderQueryMock);

        $this->erpOrderQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpOrder_In')
            ->willReturn($this->erpOrderIds)
            ->willReturn($this->erpOrderQueryMock);

        $erpOrderQuery = $this->erpOrderPageSearchQueryContainer->queryErpOrdersByErpOrderIds($this->erpOrderIds);

        $this->assertInstanceOf(ErpOrderQuery::class, $erpOrderQuery);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testQueryErpOrderWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpOrderIds()
    {
        $this->erpOrderPageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpOrderQuery')
            ->willReturn($this->erpOrderQueryMock);

        $this->erpOrderQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpOrderQueryMock);

        $this->erpOrderQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpOrder_In')
            ->willReturn($this->erpOrderIds)
            ->willReturn($this->erpOrderQueryMock);

        $erpOrderQuery = $this->erpOrderPageSearchQueryContainer
            ->queryErpOrderWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpOrderIds($this->erpOrderIds);

        $this->assertInstanceOf(ErpOrderQuery::class, $erpOrderQuery);
    }
}
