<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoice;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Propel\Runtime\Collection\CollectionIterator;
use Propel\Runtime\Collection\ObjectCollection;

class ErpInvoicePageSearchPublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit
     */
    protected $companyBusinessUnitMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAddress
     */
    protected $erpInvoiceAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface
     */
    protected $erpInvoicePageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\ErpInvoicePageSearchDataMapperInterface
     */
    protected $erpInvoicePageSearchDataMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainerInterface
     */
    protected $erpInvoicePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected $erpInvoicePageSearchToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher
     */
    protected $erpInvoicePageSearchPublisher;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceItem
     */
    protected $erpInvoiceItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceExpense
     */
    protected $erpInvoiceExpenseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Country\Persistence\SpyCountry
     */
    protected $countryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected $erpInvoiceQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoice
     */
    protected $erpInvoiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceAmount
     */
    protected $amountMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $objectCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $erpInvoiceItemCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\CollectionIterator
     */
    protected $erpInvoiceItemIteratorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $erpInvoiceExpenseCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\CollectionIterator
     */
    protected $erpInvoiceExpenseIteratorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePageSearchEntityManagerMock = $this->getMockBuilder(ErpInvoicePageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchQueryContainerMock = $this->getMockBuilder(ErpInvoicePageSearchQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpInvoicePageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchDataMapperMock = $this->getMockBuilder(ErpInvoicePageSearchDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceQueryMock = $this->getMockBuilder(FooErpInvoiceQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceMock = $this->getMockBuilder(FooErpInvoice::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryMock = $this->getMockBuilder(SpyCountry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->amountMock = $this->getMockBuilder(FooErpInvoiceAmount::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemIteratorMock = $this->getMockBuilder(CollectionIterator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceItemMock = $this->getMockBuilder(FooErpInvoiceItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseMock = $this->getMockBuilder(FooErpInvoiceExpense::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceExpenseIteratorMock = $this->getMockBuilder(CollectionIterator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitMock = $this->getMockBuilder(SpyCompanyBusinessUnit::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceAddressMock = $this->getMockBuilder(FooErpInvoiceAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchPublisher = new ErpInvoicePageSearchPublisher(
            $this->erpInvoicePageSearchEntityManagerMock,
            $this->erpInvoicePageSearchQueryContainerMock,
            $this->erpInvoicePageSearchToUtilEncodingServiceMock,
            $this->erpInvoicePageSearchDataMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testPublish()
    {
        $erpInvoiceIds = [];

        $erpInvoiceMocks = [
            $this->erpInvoiceMock,
        ];

        $this->erpInvoicePageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpInvoiceWithAddressesAndCompanyBusinessUnitByErpInvoiceIds')
            ->with($erpInvoiceIds)
            ->willReturn($this->erpInvoiceQueryMock);

        $this->erpInvoiceQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($erpInvoiceMocks);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getSpyCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitMock);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceItems')
            ->willReturn($this->erpInvoiceItemCollectionMock);

        $this->erpInvoiceItemCollectionMock->expects(static::atLeastOnce())
            ->method('getIterator')
            ->willReturn($this->erpInvoiceItemIteratorMock);

        $this->erpInvoiceItemIteratorMock->expects(static::atLeastOnce())
            ->method('rewind');

        $this->erpInvoiceItemIteratorMock->expects(static::atLeastOnce())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->erpInvoiceItemIteratorMock->expects(static::atLeastOnce())
            ->method('current')
            ->willReturn($this->erpInvoiceItemMock);

        $this->erpInvoiceItemIteratorMock->expects(static::atLeastOnce())
            ->method('next');

        $this->erpInvoiceItemMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceAmount')
            ->willReturn($this->amountMock);

        $this->amountMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpInvoiceItemMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceAmountUnitPrice')
            ->willReturn($this->amountMock);

        $this->erpInvoiceItemMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceExpenses')
            ->willReturn($this->erpInvoiceExpenseCollectionMock);

        $this->erpInvoiceExpenseCollectionMock->expects(static::atLeastOnce())
            ->method('getIterator')
            ->willReturn($this->erpInvoiceExpenseIteratorMock);

        $this->erpInvoiceExpenseIteratorMock->expects(static::atLeastOnce())
            ->method('rewind');

        $this->erpInvoiceExpenseIteratorMock->expects(static::atLeastOnce())
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->erpInvoiceExpenseIteratorMock->expects(static::atLeastOnce())
            ->method('current')
            ->willReturn($this->erpInvoiceExpenseMock);

        $this->erpInvoiceExpenseIteratorMock->expects(static::atLeastOnce())
            ->method('next');

        $this->erpInvoiceExpenseMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceAmount')
            ->willReturn($this->amountMock);

        $this->erpInvoiceExpenseMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceAmountUnitPrice')
            ->willReturn($this->amountMock);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceAmountToal')
            ->willReturn($this->amountMock);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceBillingAddress')
            ->willReturn($this->erpInvoiceAddressMock);

        $this->erpInvoiceMock->expects(static::atLeastOnce())
            ->method('getFooErpInvoiceShippingAddress')
            ->willReturn($this->erpInvoiceAddressMock);

        $this->erpInvoiceAddressMock->expects(static::atLeastOnce())
            ->method('getSpyCountry')
            ->willReturn($this->countryMock);

        $this->countryMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn('DE');

        $this->companyBusinessUnitMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->amountMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpInvoiceAddressMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpInvoicePageSearchPublisher->publish($erpInvoiceIds);
    }
}
