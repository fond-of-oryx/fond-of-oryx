<?php

namespace FondOfOryx\Yves\Prepayment\Form\DataProvider;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentFormDataProviderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Spryker\Yves\StepEngine\Dependency\Form\StepEngineFormDataProviderInterface
     */
    protected $provider;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();

        $this->provider = new PrepaymentFormDataProvider();
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $this->quoteTransferMock->expects(static::once())->method('getPayment')->willReturn(null);
        $this->quoteTransferMock->expects(static::once())->method('setPayment')->willReturnCallback(static function ($transfer) {
            static::assertInstanceOf(PaymentTransfer::class, $transfer);
        });

        $this->provider->getData($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testGetDataAlreadyHasPaymentData(): void
    {
        $this->quoteTransferMock->expects(static::once())->method('getPayment')->willReturn(new PaymentTransfer());
        $this->quoteTransferMock->expects(static::never())->method('setPayment');

        $this->provider->getData($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testGetOptions(): void
    {
        static::assertSame([], $this->provider->getOptions($this->quoteTransferMock));
    }
}
