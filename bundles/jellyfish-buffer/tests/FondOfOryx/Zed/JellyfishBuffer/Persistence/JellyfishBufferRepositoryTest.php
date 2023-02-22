<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishBufferRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ExportedOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $exportedOrderTransferMock;

    /**
     * @var \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $exportedOrderQueryMock;

    /**
     * @var \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $objectCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(JellyfishBufferTableFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportedOrderTransferMock = $this->getMockBuilder(ExportedOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferPersistenceFactoryMock = $this->getMockBuilder(JellyfishBufferPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferMapperMock = $this->getMockBuilder(JellyfishBufferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportedOrderQueryMock = $this->getMockBuilder(FooExportedOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMock = $this->getMockBuilder(FooExportedOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new JellyfishBufferRepository();
        $this->repository->setFactory($this->jellyfishBufferPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindBufferedOrders(): void
    {
        $this->jellyfishBufferPersistenceFactoryMock->expects(static::atLeastOnce())->method('createExportedOrderQuery')->willReturn($this->exportedOrderQueryMock);
        $this->jellyfishBufferPersistenceFactoryMock->expects(static::once())->method('createJellyfishBufferMapper')->willReturn($this->jellyfishBufferMapperMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getForceReexport')->willReturn(false);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([1]);
        $this->exportedOrderQueryMock->expects(static::once())->method('filterByIsReexported')->with(false);
        $this->exportedOrderQueryMock->expects(static::atLeastOnce())->method('filterByStore');
        $this->exportedOrderQueryMock->expects(static::atLeastOnce())->method('filterByFkSalesOrder_In')->willReturnSelf();
        $this->exportedOrderQueryMock->expects(static::never())->method('filterByFkSalesOrder_Between');
        $this->exportedOrderQueryMock->expects(static::once())->method('find')->willReturn($this->objectCollectionMock);
        $this->objectCollectionMock->expects(static::atLeastOnce())->method('getData')->willReturn([$this->entityMock]);

        $this->jellyfishBufferMapperMock->expects(static::once())->method('fromEntity')->willReturn($this->exportedOrderTransferMock);

        $collection = $this->repository->findBufferedOrders($this->filterTransferMock);

        static::assertSame(1, $collection->getCount());
    }

    /**
     * @return void
     */
    public function testFindBufferedOrdersWithRange(): void
    {
        $this->jellyfishBufferPersistenceFactoryMock->expects(static::atLeastOnce())->method('createExportedOrderQuery')->willReturn($this->exportedOrderQueryMock);
        $this->jellyfishBufferPersistenceFactoryMock->expects(static::once())->method('createJellyfishBufferMapper')->willReturn($this->jellyfishBufferMapperMock);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getForceReexport')->willReturn(false);
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getStore')->willReturn('testStore');
        $this->filterTransferMock->expects(static::atLeastOnce())->method('getIds')->willReturn([]);
        $this->filterTransferMock->expects(static::once())->method('getRangeFrom')->willReturn(1);
        $this->filterTransferMock->expects(static::once())->method('getRangeTo')->willReturn(10);
        $this->exportedOrderQueryMock->expects(static::once())->method('filterByIsReexported')->with(false);
        $this->exportedOrderQueryMock->expects(static::atLeastOnce())->method('filterByStore');
        $this->exportedOrderQueryMock->expects(static::never())->method('filterByFkSalesOrder_In');
        $this->exportedOrderQueryMock->expects(static::once())->method('filterByFkSalesOrder_Between')->willReturnSelf();
        $this->exportedOrderQueryMock->expects(static::once())->method('find')->willReturn($this->objectCollectionMock);
        $this->objectCollectionMock->expects(static::atLeastOnce())->method('getData')->willReturn([$this->entityMock]);
        $this->jellyfishBufferMapperMock->expects(static::once())->method('fromEntity')->willReturn($this->exportedOrderTransferMock);

        $collection = $this->repository->findBufferedOrders($this->filterTransferMock);

        static::assertSame(1, $collection->getCount());
    }
}
