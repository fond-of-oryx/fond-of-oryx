<?php

namespace FondOfOryx\Zed\PaymentTotalAmountRestriction\Communication;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionFacade;
use Generated\Shared\Transfer\PaymentMethodsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class TotalAmountRestrictionPaymentMethodFilterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    protected $paymentMethodsTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\PaymentTotalAmountRestriction\Business\PaymentTotalAmountRestrictionFacade
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\PaymentTotalAmountRestriction\Communication\TotalAmountRestrictionPaymentMethodFilterPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paymentMethodsTransferMock = $this->getMockBuilder(PaymentMethodsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(PaymentTotalAmountRestrictionFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new TotalAmountRestrictionPaymentMethodFilterPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }
}
