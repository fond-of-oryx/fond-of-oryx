<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\ErpOrder\Persistence\ErpOrder;
use Orm\Zed\ErpOrder\Persistence\ErpOrderAddress;
use Orm\Zed\ErpOrder\Persistence\ErpOrderItem;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Propel\Runtime\Collection\ObjectCollection;

class ErpOrderPageSearchPublisherTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit
     */
    protected $companyBusinessUnitMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderAddress
     */
    protected $erpOrderAddressMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface
     */
    protected $erpOrderPageSearchEntityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\ErpOrderPageSearchDataMapperInterface
     */
    protected $erpOrderPageSearchDataMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface
     */
    protected $erpOrderPageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Service\ErpOrderPageSearchToUtilEncodingServiceInterface
     */
    protected $erpOrderPageSearchToUtilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Publisher\ErpOrderPageSearchPublisher
     */
    protected $erpOrderPageSearchPublisher;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderItem
     */
    protected $erpOrderItemMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $erpOrderItemObjectCollectionMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $erpOrderQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrder
     */
    protected $erpOrderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $objectCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPageSearchEntityManagerMock = $this->getMockBuilder(ErpOrderPageSearchEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchQueryContainerMock = $this->getMockBuilder(ErpOrderPageSearchQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToUtilEncodingServiceMock = $this->getMockBuilder(ErpOrderPageSearchToUtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchDataMapperMock = $this->getMockBuilder(ErpOrderPageSearchDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderQueryMock = $this->getMockBuilder(ErpOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemObjectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderMock = $this->getMockBuilder(ErpOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemMock = $this->getMockBuilder(ErpOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitMock = $this->getMockBuilder(SpyCompanyBusinessUnit::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderAddressMock = $this->getMockBuilder(ErpOrderAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchPublisher = new ErpOrderPageSearchPublisher(
            $this->erpOrderPageSearchEntityManagerMock,
            $this->erpOrderPageSearchQueryContainerMock,
            $this->erpOrderPageSearchToUtilEncodingServiceMock,
            $this->erpOrderPageSearchDataMapperMock
        );
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testPublish()
    {
        $erpOrderIds = [];

        $orderEntities = [
            $this->erpOrderMock,
        ];

        $updatedAt = new DateTime('NOW');

        $this->erpOrderPageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpOrderWithAddressesAndCompanyBusinessUnitAndCompanyUserByErpOrderIds')
            ->with($erpOrderIds)
            ->willReturn($this->erpOrderQueryMock);

        $this->erpOrderQueryMock->expects(static::atLeastOnce())
            ->method('find')
            ->willReturn($this->objectCollectionMock);

        $this->objectCollectionMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($orderEntities);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitMock);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUser);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getErpOrderItems')
            ->willReturn($this->erpOrderItemObjectCollectionMock);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getErpOrderBillingAddress')
            ->willReturn($this->erpOrderAddressMock);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getErpOrderShippingAddress')
            ->willReturn($this->erpOrderAddressMock);

        $this->companyBusinessUnitMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpOrderItemObjectCollectionMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpOrderAddressMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->erpOrderMock->expects(static::atLeastOnce())
            ->method('getUpdatedAt')
            ->willReturn($updatedAt);

        $this->erpOrderPageSearchPublisher->publish($erpOrderIds);
    }
}
