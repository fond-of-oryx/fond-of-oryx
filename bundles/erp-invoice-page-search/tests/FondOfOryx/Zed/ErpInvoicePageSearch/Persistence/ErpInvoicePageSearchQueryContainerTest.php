<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Codeception\Test\Unit;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;

class ErpInvoicePageSearchQueryContainerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected $erpInvoiceQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpInvoicePageSearchEntityTransfer
     */
    protected $erpInvoicePageSearchPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface
     */
    protected $erpInvoicePageSearchQueryContainer;

    /**
     * @var array<int>
     */
    protected $erpInvoiceIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoiceQueryMock = $this->getMockBuilder(FooErpInvoiceQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchPersistenceFactoryMock = $this->getMockBuilder(ErpInvoicePageSearchPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceIds = [1];

        $this->erpInvoicePageSearchQueryContainer = new ErpInvoicePageSearchQueryContainer();
        $this->erpInvoicePageSearchQueryContainer->setFactory($this->erpInvoicePageSearchPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testQueryErpInvoicesByErpInvoiceIds(): void
    {
        $this->erpInvoicePageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoiceQuery')
            ->willReturn($this->erpInvoiceQueryMock);

        $this->erpInvoiceQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpInvoiceQueryMock);

        $this->erpInvoiceQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpInvoice_In')
            ->willReturn($this->erpInvoiceIds)
            ->willReturn($this->erpInvoiceQueryMock);

        $erpInvoiceQuery = $this->erpInvoicePageSearchQueryContainer->queryErpInvoicesByErpInvoiceIds($this->erpInvoiceIds);

        $this->assertInstanceOf(FooErpInvoiceQuery::class, $erpInvoiceQuery);
    }

    /**
     * @return void
     */
    public function testQueryErpInvoiceWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpInvoiceIds()
    {
        $this->erpInvoicePageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoiceQuery')
            ->willReturn($this->erpInvoiceQueryMock);

        $this->erpInvoiceQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpInvoiceQueryMock);

        $this->erpInvoiceQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpInvoice_In')
            ->willReturn($this->erpInvoiceIds)
            ->willReturn($this->erpInvoiceQueryMock);

        $erpInvoiceQuery = $this->erpInvoicePageSearchQueryContainer
            ->queryErpInvoiceWithAddressesAndCompanyBusinessUnitByErpInvoiceIds($this->erpInvoiceIds);

        $this->assertInstanceOf(FooErpInvoiceQuery::class, $erpInvoiceQuery);
    }
}
