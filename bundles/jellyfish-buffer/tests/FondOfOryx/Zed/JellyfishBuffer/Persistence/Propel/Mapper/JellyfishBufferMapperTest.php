<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder;

class JellyfishBufferMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\Propel\Mapper\JellyfishBufferMapper
     */
    protected $jellyfishBufferMapper;

    /**
     * @var \Orm\Zed\JellyfishBuffer\Persistence\FooExportedOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooExportedOrderMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->fooExportedOrderMock = $this->getMockBuilder(FooExportedOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->options = [];

        $this->id = 'id';

        $this->reference = 'reference';

        $this->jellyfishBufferMapper = new JellyfishBufferMapper();
    }

    /**
     * @return void
     */
    public function testMapTransferAndOptionsToEntity(): void
    {
        $this->jellyfishOrderTransferMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->fooExportedOrderMock->expects($this->atLeastOnce())
            ->method('setFkSalesOrder')
            ->with($this->id)
            ->willReturnSelf();

        $this->jellyfishOrderTransferMock->expects($this->atLeastOnce())
            ->method('getReference')
            ->willReturn($this->reference);

        $this->fooExportedOrderMock->expects($this->atLeastOnce())
            ->method('setOrderReference')
            ->with($this->reference)
            ->willReturnSelf();

        $this->fooExportedOrderMock->expects($this->atLeastOnce())
            ->method('setData')
            ->willReturnSelf();

        $this->fooExportedOrderMock->expects($this->atLeastOnce())
            ->method('setStore')
            ->willReturnSelf();

        $this->assertSame(
            $this->fooExportedOrderMock,
            $this->jellyfishBufferMapper->mapTransferAndOptionsToEntity(
                $this->jellyfishOrderTransferMock,
                $this->options,
                $this->fooExportedOrderMock
            )
        );
    }
}
