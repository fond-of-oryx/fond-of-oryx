<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery;

class JellyfishBufferEntityManagerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManager
     */
    protected $jellyfishBufferEntityManger;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $exportedOrderQueryMock;

    /**
     * @var \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityMock;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferPersistenceFactoryMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferMapperMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->options = [];

        $this->jellyfishBufferPersistenceFactoryMock = $this->getMockBuilder(JellyfishBufferPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferMapperMock = $this->getMockBuilder(JellyfishBufferMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->exportedOrderQueryMock = $this->getMockBuilder(FooExportedOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityMock = $this->getMockBuilder(FooExportedOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishBufferEntityManger = new JellyfishBufferEntityManager();
        $this->jellyfishBufferEntityManger->setFactory($this->jellyfishBufferPersistenceFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateExportedOrder(): void
    {
        $this->jellyfishOrderTransferMock->expects($this->atLeastOnce())
            ->method('requireId')
            ->willReturnSelf();

        $this->jellyfishOrderTransferMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn(1);

        $this->jellyfishOrderTransferMock->expects($this->atLeastOnce())
            ->method('requireReference')
            ->willReturnSelf();

        $this->jellyfishBufferPersistenceFactoryMock->expects($this->atLeastOnce())
            ->method('createJellyfishBufferMapper')
            ->willReturn($this->jellyfishBufferMapperMock);

        $this->jellyfishBufferPersistenceFactoryMock->expects($this->atLeastOnce())
            ->method('createExportedOrderQuery')
            ->willReturn($this->exportedOrderQueryMock);

        $this->exportedOrderQueryMock->expects($this->atLeastOnce())
            ->method('filterByFkSalesOrder')
            ->willReturnSelf();

        $this->exportedOrderQueryMock->expects($this->atLeastOnce())
            ->method('findOneOrCreate')
            ->willReturn($this->entityMock);

        $this->jellyfishBufferMapperMock->expects($this->atLeastOnce())
            ->method('mapTransferAndOptionsToEntity');

        $this->jellyfishBufferEntityManger->createExportedOrder(
            $this->jellyfishOrderTransferMock,
            $this->options,
        );
    }
}
