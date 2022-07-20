<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishOrderGiftCardTransfer;
use Orm\Zed\GiftCard\Persistence\SpyPaymentGiftCard;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Propel\Runtime\Collection\ObjectCollection;

class JellyfishOrderGiftCardMapperTest extends Unit
{
 /**
  * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPayment
  */
    protected $salesPaymentMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyPaymentGiftCard
     */
    protected $paymentGiftCardMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Propel\Runtime\Collection\ObjectCollection
     */
    protected $paymentGiftCardCollectionMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->salesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentGiftCardMock = $this->getMockBuilder(SpyPaymentGiftCard::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paymentGiftCardCollectionMock = $this->getMockBuilder(ObjectCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderGiftCardMapper = new JellyfishOrderGiftCardMapper();
    }

    /**
     * @return void
     */
    public function testFromSalesPayment(): void
    {
        $data = [
            'amount' => '1000',
            'giftCardPayments' => $this->paymentGiftCardCollectionMock,
            'code' => 'code',
        ];

        $this->salesPaymentMock->expects(static::atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['amount']);

        $this->salesPaymentMock->expects(static::atLeastOnce())
            ->method('getSpyGiftCardPayments')
            ->willReturn($data['giftCardPayments']);

        $this->paymentGiftCardCollectionMock->expects(static::atLeastOnce())
            ->method('offsetGet')
            ->with(0)
            ->willReturn($this->paymentGiftCardMock);

        $this->paymentGiftCardMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($data['code']);

        $jellyfishOrderGiftCardTransfer = $this->jellyfishOrderGiftCardMapper
            ->fromSalesPayment($this->salesPaymentMock);

        static::assertInstanceOf(JellyfishOrderGiftCardTransfer::class, $jellyfishOrderGiftCardTransfer);
        static::assertEquals($data['amount'], $jellyfishOrderGiftCardTransfer->getAmount());
        static::assertEquals($data['code'], $jellyfishOrderGiftCardTransfer->getCode());
    }
}
