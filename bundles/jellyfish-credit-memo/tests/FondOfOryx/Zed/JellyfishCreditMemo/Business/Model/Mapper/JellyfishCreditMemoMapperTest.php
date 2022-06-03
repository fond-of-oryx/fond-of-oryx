<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class JellyfishCreditMemoMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Dependency\Facade\JellyfishCreditMemoToSalesFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransfer;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransfer;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransfer;

    /**
     * @var \FondOfOryx\Zed\JellyfishCreditMemo\Business\Model\Mapper\JellyfishCreditMemoMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->salesFacadeMock = $this->getMockBuilder(JellyfishCreditMemoToSalesFacadeInterface::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->customerTransfer = $this->getMockBuilder(CustomerTransfer::class)->disableOriginalConstructor()->getMock();
        $this->itemTransfer = $this->getMockBuilder(ItemTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransfer = $this->getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();

        $this->mapper = new JellyfishCreditMemoMapper($this->salesFacadeMock);
    }

    /**
     * @return void
     */
    public function testMapCreditMemoTransferToJellyfishCreditMemoTransfer(): void
    {
        $items = new ArrayObject([$this->itemTransfer]);
        $this->salesFacadeMock->expects(static::once())->method('findOrderByIdSalesOrder')->willReturn($this->orderTransferMock);
        $this->orderTransferMock->expects(static::once())->method('getCustomer')->willReturn($this->customerTransfer);
        $this->creditMemoTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getStore')->willReturn('STORE_COM');
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->creditMemoTransferMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransfer);
        $this->localeTransfer->expects(static::once())->method('getLocaleName')->willReturn('de_DE');
        $this->creditMemoTransferMock->expects(static::once())->method('getCreatedAt')->willReturn('20.07.1985');
        $this->creditMemoTransferMock->expects(static::once())->method('getUpdatedAt')->willReturn('16.08.1987');
        $this->creditMemoTransferMock->expects(static::once())->method('getProcessedAt')->willReturn('12.06.2021 14:00:00');
        $this->creditMemoTransferMock->expects(static::once())->method('getRefundedAmount')->willReturn(10);
        $this->creditMemoTransferMock->expects(static::once())->method('getRefundedTaxAmount')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getChargeAmount')->willReturn(20);
        $this->creditMemoTransferMock->expects(static::once())->method('getChargeTaxAmount')->willReturn(2);
        $this->creditMemoTransferMock->expects(static::once())->method('getTotalAmount')->willReturn(30);
        $this->creditMemoTransferMock->expects(static::once())->method('getTotalTaxAmount')->willReturn(3);

        $response = $this->mapper->mapCreditMemoTransferToJellyfishCreditMemoTransfer($this->creditMemoTransferMock);

        static::assertSame('1985-07-20 00:00:00', $response->getCreatedAt());
        static::assertSame('2021-06-12 14:00:00', $response->getProcessedAt());
        static::assertSame('STORE', $response->getSystemCode());
        static::assertSame('de_DE', $response->getLocale());
        static::assertSame(10, $response->getRefundedTotal()->getAmount());
        static::assertSame(1, $response->getRefundedTotal()->getTaxAmount());
        static::assertSame(20, $response->getChargedTotal()->getAmount());
        static::assertSame(2, $response->getChargedTotal()->getTaxAmount());
        static::assertSame(30, $response->getPaidTotal()->getAmount());
        static::assertSame(3, $response->getPaidTotal()->getTaxAmount());
    }

    /**
     * @return void
     */
    public function testMapCreditMemoTransferToJellyfishCreditMemoTransferStateFromKey(): void
    {
        $items = new ArrayObject([$this->itemTransfer]);
        $this->salesFacadeMock->expects(static::once())->method('findOrderByIdSalesOrder')->willReturn($this->orderTransferMock);
        $this->orderTransferMock->expects(static::once())->method('getCustomer')->willReturn($this->customerTransfer);
        $this->creditMemoTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getStore')->willReturn('STORE_COM');
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->creditMemoTransferMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransfer);
        $this->creditMemoTransferMock->expects(static::once())->method('getCreatedAt')->willReturn('20.07.1985');
        $this->creditMemoTransferMock->expects(static::once())->method('getUpdatedAt')->willReturn('16.08.1987');
        $this->creditMemoTransferMock->expects(static::once())->method('getProcessedAt')->willReturn('12.06.2021 14:00:00');
        $this->creditMemoTransferMock->expects(static::once())->method('getState')->willReturn('complete');
        $this->localeTransfer->expects(static::once())->method('getLocaleName')->willReturn('de_DE');

        $response = $this->mapper->mapCreditMemoTransferToJellyfishCreditMemoTransfer($this->creditMemoTransferMock);

        static::assertSame('complete', $response->getState());
    }

    /**
     * @return void
     */
    public function testMapCreditMemoTransferToJellyfishCreditMemoTransferStateFromValue(): void
    {
        $items = new ArrayObject([$this->itemTransfer]);
        $this->salesFacadeMock->expects(static::once())->method('findOrderByIdSalesOrder')->willReturn($this->orderTransferMock);
        $this->orderTransferMock->expects(static::once())->method('getCustomer')->willReturn($this->customerTransfer);
        $this->creditMemoTransferMock->expects(static::once())->method('getFkSalesOrder')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::exactly(2))->method('getStore')->willReturn('STORE_COM');
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn($items);
        $this->creditMemoTransferMock->expects(static::once())->method('getLocale')->willReturn($this->localeTransfer);
        $this->creditMemoTransferMock->expects(static::once())->method('getCreatedAt')->willReturn('20.07.1985');
        $this->creditMemoTransferMock->expects(static::once())->method('getUpdatedAt')->willReturn('16.08.1987');
        $this->creditMemoTransferMock->expects(static::once())->method('getProcessedAt')->willReturn('12.06.2021 14:00:00');
        $this->creditMemoTransferMock->expects(static::once())->method('getState')->willReturn(3);
        $this->localeTransfer->expects(static::once())->method('getLocaleName')->willReturn('de_DE');

        $response = $this->mapper->mapCreditMemoTransferToJellyfishCreditMemoTransfer($this->creditMemoTransferMock);

        static::assertSame('error', $response->getState());
    }
}
