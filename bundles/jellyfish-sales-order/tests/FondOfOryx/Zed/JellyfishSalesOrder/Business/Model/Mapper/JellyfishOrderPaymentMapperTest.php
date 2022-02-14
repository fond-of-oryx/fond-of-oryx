<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapper;
use Generated\Shared\Transfer\JellyfishOrderPaymentTransfer;
use Orm\Zed\Payment\Persistence\SpySalesPayment;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;

class JellyfishOrderPaymentMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapper
     */
    protected $jellyfishOrderPaymentMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPayment
     */
    protected $spySalesPaymentMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType
     */
    protected $spySalesPaymentMethodTypeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spySalesPaymentMock = $this->getMockBuilder(SpySalesPayment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesPaymentMethodTypeMock = $this->getMockBuilder(SpySalesPaymentMethodType::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderPaymentMapper = new JellyfishOrderPaymentMapper();
    }

    /**
     * @return void
     */
    public function testFromSalesPayment(): void
    {
        $data = [
            'amount' => 19.90,
            'payment_method' => 'creditcard',
            'payment_provider' => 'provider',
        ];

        $this->spySalesPaymentMock->expects($this->atLeastOnce())
            ->method('getAmount')
            ->willReturn($data['amount']);

        $this->spySalesPaymentMock->expects($this->atLeastOnce())
            ->method('getSalesPaymentMethodType')
            ->willReturn($this->spySalesPaymentMethodTypeMock);

        $this->spySalesPaymentMethodTypeMock->expects($this->atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn($data['payment_method']);

        $this->spySalesPaymentMethodTypeMock->expects($this->atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn($data['payment_provider']);

        $jellyfishOrderPaymentTransfer = $this->jellyfishOrderPaymentMapper->fromSalesPayment($this->spySalesPaymentMock);

        $this->assertInstanceOf(JellyfishOrderPaymentTransfer::class, $jellyfishOrderPaymentTransfer);
        $this->assertEquals($data['amount'], $jellyfishOrderPaymentTransfer->getAmount());
        $this->assertEquals($data['payment_method'], $jellyfishOrderPaymentTransfer->getMethod());
        $this->assertEquals($data['payment_provider'], $jellyfishOrderPaymentTransfer->getProvider());
    }
}
