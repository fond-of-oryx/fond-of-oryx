<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentTransfer;

class MailjetTemplateVariablesPaymentsMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PaymentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paymentTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesPaymentsMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentTransferMock = $this->getMockBuilder(PaymentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new MailjetTemplateVariablesPaymentsMapper();
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentProvider')
            ->willReturn('Payment Provider');

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getPaymentMethod')
            ->willReturn('Payment Method');

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getAccountHolder')
            ->willReturn('Account Holder');

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getIban')
            ->willReturn('IBAN');

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getBank')
            ->willReturn('Bank');

        $this->paymentTransferMock->expects(static::atLeastOnce())
            ->method('getBic')
            ->willReturn('BIC');

        $response = $this->mapper->map(new ArrayObject([$this->paymentTransferMock]));

        static::assertCount(1, $response);
        static::assertCount(6, $response[0]);
    }
}
