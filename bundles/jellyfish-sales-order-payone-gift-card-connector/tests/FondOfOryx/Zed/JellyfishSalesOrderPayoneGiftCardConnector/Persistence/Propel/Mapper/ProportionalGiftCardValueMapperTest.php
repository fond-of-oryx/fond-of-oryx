<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue;

class ProportionalGiftCardValueMapperTest extends Unit
{
    /**
     * @var \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $entityMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\Propel\Mapper\ProportionalGiftCardValueMapper
     */
    protected $mapper;

    /**
     * @var \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $propotionalGiftCardValueTransferMock;

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

        $this->entityMock = $this
            ->getMockBuilder(FooProportionalGiftCardValue::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ProportionalGiftCardValueMapper();
    }

    /**
     * @return void
     */
    public function testMapTransferToEntity(): void
    {
        $this->propotionalGiftCardValueTransferMock->expects(static::atLeastOnce())
            ->method('modifiedToArray')
            ->willReturn([]);

        static::assertInstanceOf(
            FooProportionalGiftCardValue::class,
            $this->mapper->mapTransferToEntity($this->propotionalGiftCardValueTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->entityMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        static::assertInstanceOf(
            ProportionalGiftCardValueTransfer::class,
            $this->mapper->mapEntityToTransfer($this->entityMock),
        );
    }
}
