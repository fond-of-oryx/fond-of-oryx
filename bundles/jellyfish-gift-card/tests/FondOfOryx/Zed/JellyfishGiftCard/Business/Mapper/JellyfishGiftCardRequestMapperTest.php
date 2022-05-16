<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishGiftCardRequestMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFilterMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderItemEntityMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapper
     */
    protected $jellyfishGiftCardRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeFilterMock = $this->getMockBuilder(LocaleFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardFacadeMock = $this->getMockBuilder(JellyfishGiftCardToGiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesFacadeMock = $this->getMockBuilder(JellyfishGiftCardToSalesFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderItemEntityMock = $this->getMockBuilder(SpySalesOrderItem::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestMapper = new JellyfishGiftCardRequestMapper(
            $this->localeFilterMock,
            $this->giftCardFacadeMock,
            $this->salesFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItem(): void
    {
        $idSalesOrderItem = 1;

        $this->salesOrderItemEntityMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($idSalesOrderItem);

        $this->giftCardFacadeMock->expects(static::atLeastOnce())
            ->method('findGiftCardByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($this->giftCardTransferMock);

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($this->orderTransferMock);

        $this->localeFilterMock->expects(static::atLeastOnce())
            ->method('fromSpySalesOrderItem')
            ->with($this->salesOrderItemEntityMock)
            ->willReturn($this->localeTransferMock);

        $jellyfishGiftCardRequestTransfer = $this->jellyfishGiftCardRequestMapper
            ->fromSalesOrderItem($this->salesOrderItemEntityMock);

        static::assertEquals($this->localeTransferMock, $jellyfishGiftCardRequestTransfer->getLocale());
    }

    /**
     * @return void
     */
    public function testFromSalesOrderItemWithNonExistingOrder(): void
    {
        $idSalesOrderItem = 1;

        $this->salesOrderItemEntityMock->expects(static::atLeastOnce())
            ->method('getIdSalesOrderItem')
            ->willReturn($idSalesOrderItem);

        $this->giftCardFacadeMock->expects(static::atLeastOnce())
            ->method('findGiftCardByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn($this->giftCardTransferMock);

        $this->salesFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderByIdSalesOrderItem')
            ->with($idSalesOrderItem)
            ->willReturn(null);

        $this->localeFilterMock->expects(static::never())
            ->method('fromSpySalesOrderItem');

        $jellyfishGiftCardRequestTransfer = $this->jellyfishGiftCardRequestMapper
            ->fromSalesOrderItem($this->salesOrderItemEntityMock);

        static::assertEquals(null, $jellyfishGiftCardRequestTransfer->getLocale());
    }
}
