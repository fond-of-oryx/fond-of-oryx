<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery;

class JellyfishSalesOrderPayoneGiftCardConnectorRepositoryTest extends Unit
{
    /**
     * @var \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $mapperMock;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $propotionalGiftCardValueTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorRepository
     */
    protected $repository;

    /**
     * @var \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValueQuery|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $queryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->propotionalGiftCardValueTransferMock = $this
            ->getMockBuilder(ProportionalGiftCardValueTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this
            ->getMockBuilder(FooProportionalGiftCardValueQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMock = $this
            ->getMockBuilder(FooProportionalGiftCardValue::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapperMock = $this
            ->getMockBuilder(ProportionalGiftCardValueMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new JellyfishSalesOrderPayoneGiftCardConnectorRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindProportionalGiftCardValue(): void
    {
        $sku = 'sku';
        $value = 1;
        $orderReference = 'order-reference';

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireSku')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireValue')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireOrderReference')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterBySku')
            ->with($sku)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByValue')
            ->with($value)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByOrderreference')
            ->with($orderReference)
            ->willReturn($this->queryMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($value);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn($this->entityMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueMapper')
            ->willReturn($this->mapperMock);

        $this->mapperMock->expects(static::atLeastOnce())
            ->method('mapEntityToTransfer')
            ->with($this->entityMock)
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        static::assertInstanceOf(
            ProportionalGiftCardValueTransfer::class,
            $this->repository->findProportionalGiftCardValue($this->propotionalGiftCardValueTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testFindProportionalGiftCardValueWithNullResult(): void
    {
        $sku = 'sku';
        $value = 1;
        $orderReference = 'order-reference';

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireSku')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireValue')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('requireOrderReference')
            ->willReturn($this->propotionalGiftCardValueTransferMock);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProportionalGiftCardValueQuery')
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterBySku')
            ->with($sku)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByValue')
            ->with($value)
            ->willReturn($this->queryMock);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('filterByOrderreference')
            ->with($orderReference)
            ->willReturn($this->queryMock);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getSku')
            ->willReturn($sku);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($value);

        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('getOrderReference')
            ->willReturn($orderReference);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('findOne')
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->repository->findProportionalGiftCardValue($this->propotionalGiftCardValueTransferMock),
        );
    }
}
