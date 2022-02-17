<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Codeception\Test\Unit;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;

class ErpDeliveryNotePageSearchQueryContainerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected $erpDeliveryNoteQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpDeliveryNotePageSearchEntityTransfer
     */
    protected $erpDeliveryNotePageSearchPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainerInterface
     */
    protected $erpDeliveryNotePageSearchQueryContainer;

    /**
     * @var array<int>
     */
    protected $erpDeliveryNoteIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNoteQueryMock = $this->getMockBuilder(FooErpDeliveryNoteQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchPersistenceFactoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteIds = [1];

        $this->erpDeliveryNotePageSearchQueryContainer = new ErpDeliveryNotePageSearchQueryContainer();
        $this->erpDeliveryNotePageSearchQueryContainer->setFactory($this->erpDeliveryNotePageSearchPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testQueryErpDeliveryNotesByErpDeliveryNoteIds(): void
    {
        $this->erpDeliveryNotePageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNoteQuery')
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->erpDeliveryNoteQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->erpDeliveryNoteQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpDeliveryNote_In')
            ->willReturn($this->erpDeliveryNoteIds)
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $erpDeliveryNoteQuery = $this->erpDeliveryNotePageSearchQueryContainer->queryErpDeliveryNotesByErpDeliveryNoteIds($this->erpDeliveryNoteIds);

        $this->assertInstanceOf(FooErpDeliveryNoteQuery::class, $erpDeliveryNoteQuery);
    }

    /**
     * @return void
     */
    public function testQueryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpDeliveryNoteIds()
    {
        $this->erpDeliveryNotePageSearchPersistenceFactoryMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNoteQuery')
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->erpDeliveryNoteQueryMock->expects(static::atLeastOnce())
            ->method('clear')
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->erpDeliveryNoteQueryMock->expects(static::atLeastOnce())
            ->method('filterByIdErpDeliveryNote_In')
            ->willReturn($this->erpDeliveryNoteIds)
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $erpDeliveryNoteQuery = $this->erpDeliveryNotePageSearchQueryContainer
            ->queryErpDeliveryNoteWithAddressesAndCompanyBusinessUnitByErpDeliveryNoteIds($this->erpDeliveryNoteIds);

        $this->assertInstanceOf(FooErpDeliveryNoteQuery::class, $erpDeliveryNoteQuery);
    }
}
