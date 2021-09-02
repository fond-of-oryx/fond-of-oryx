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
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPayment
     */
    protected $spySalesPaymentMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\GiftCard\Persistence\SpyPaymentGiftCard
     */
    protected $spyPaymentGiftCardMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyPaymentGiftCardMock = $this->getMockBuilder(SpyPaymentGiftCard::class)
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
            'giftCardPayments' => new ObjectCollection([$this->spyPaymentGiftCardMock]),
            'code' => 'code',
        ];

        $this->spySalesPaymentMock->expects($this->atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['amount']);

        $this->spySalesPaymentMock->expects($this->atLeastOnce())
            ->method('getSpyGiftCardPayments')
            ->willReturn($data['giftCardPayments']);

        $this->spyPaymentGiftCardMock->expects($this->atLeastOnce())
            ->method('getCode')
            ->willReturn($data['code']);

        $jellyfishOrderGiftCardTransfer = $this->jellyfishOrderGiftCardMapper
            ->fromSalesPayment($this->spySalesPaymentMock);

        $this->assertInstanceOf(JellyfishOrderGiftCardTransfer::class, $jellyfishOrderGiftCardTransfer);
        $this->assertEquals($data['amount'], $jellyfishOrderGiftCardTransfer->getAmount());
        $this->assertEquals($data['code'], $jellyfishOrderGiftCardTransfer->getCode());
    }
}
