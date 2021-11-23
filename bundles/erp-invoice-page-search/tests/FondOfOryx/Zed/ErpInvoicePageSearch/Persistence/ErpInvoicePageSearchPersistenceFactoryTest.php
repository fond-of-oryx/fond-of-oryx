<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\Propel\Mapper\ErpInvoicePageSearchMapperInterface;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery;
use Spryker\Zed\Kernel\Container;

class ErpInvoicePageSearchPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchPersistenceFactory;
     */
    protected $erpInvoicePageSearchPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoicePageSearch\Persistence\FooErpInvoicePageSearchQuery
     */
    protected $erpInvoiceQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected $fooErpInvoicePageSearchQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpInvoicePageSearchQueryMock = $this->getMockBuilder(FooErpInvoicePageSearchQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceQueryMock = $this->getMockBuilder(FooErpInvoiceQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchPersistenceFactory = new ErpInvoicePageSearchPersistenceFactory();
        $this->erpInvoicePageSearchPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoicePageSearchMapper()
    {
        $this->assertInstanceOf(
            ErpInvoicePageSearchMapperInterface::class,
            $this->erpInvoicePageSearchPersistenceFactory->createErpInvoicePageSearchMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpInvoicePageSearchQuery()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE_PAGE_SEARCH)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE_PAGE_SEARCH],
            )->willReturnOnConsecutiveCalls(
                $this->fooErpInvoicePageSearchQueryMock,
            );

        $this->assertInstanceOf(
            FooErpInvoicePageSearchQuery::class,
            $this->erpInvoicePageSearchPersistenceFactory->getErpInvoicePageSearchQuery(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpInvoiceQuery()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::QUERY_ERP_INVOICE)
            ->willReturn($this->erpInvoiceQueryMock);

        $this->assertInstanceOf(
            FooErpInvoiceQuery::class,
            $this->erpInvoicePageSearchPersistenceFactory->getErpInvoiceQuery(),
        );
    }
}
