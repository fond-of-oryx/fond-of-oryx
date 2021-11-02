<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface;
use Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class GiftCardExporterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardDataWrapperMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardApiAdapterMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardDataWrapperTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemEntityMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject
     */
    protected $readOnlyArrayObjectMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter\GiftCardExporter
     */
    protected $giftCardExporter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishGiftCardRequestMapperMock = $this->getMockBuilder(JellyfishGiftCardRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataWrapperMapperMock = $this->getMockBuilder(JellyfishGiftCardDataWrapperMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardApiAdapterMock = $this->getMockBuilder(GiftCardApiAdapterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataWrapperTransferMock = $this->getMockBuilder(JellyfishGiftCardDataWrapperTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemEntityMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->readOnlyArrayObjectMock = $this->getMockBuilder(ReadOnlyArrayObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardExporter = new GiftCardExporter(
            $this->jellyfishGiftCardRequestMapperMock,
            $this->jellyfishGiftCardDataWrapperMapperMock,
            $this->giftCardApiAdapterMock,
        );
    }

    /**
     * @return void
     */
    public function testExport(): void
    {
        $this->jellyfishGiftCardRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesOrderItem')
            ->with($this->salesOrderItemEntityMock)
            ->willReturn($this->jellyfishGiftCardRequestTransferMock);

        $this->jellyfishGiftCardDataWrapperMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishGiftCardDataWrapperTransferMock);

        $this->giftCardApiAdapterMock->expects(static::atLeastOnce())
            ->method('post')
            ->with($this->jellyfishGiftCardDataWrapperTransferMock);

        $this->giftCardExporter->export($this->salesOrderItemEntityMock, $this->readOnlyArrayObjectMock);
    }

    /**
     * @return void
     */
    public function testExportWithException(): void
    {
        $this->jellyfishGiftCardRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromSalesOrderItem')
            ->with($this->salesOrderItemEntityMock)
            ->willReturn($this->jellyfishGiftCardRequestTransferMock);

        $this->jellyfishGiftCardDataWrapperMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn(null);

        $this->giftCardApiAdapterMock->expects(static::never())
            ->method('post');

        try {
            $this->giftCardExporter->export($this->salesOrderItemEntityMock, $this->readOnlyArrayObjectMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }
}
