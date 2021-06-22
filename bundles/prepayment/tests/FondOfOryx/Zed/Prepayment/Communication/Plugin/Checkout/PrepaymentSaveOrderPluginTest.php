<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Checkout;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentSaveOrderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CheckoutResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $checkoutResponseTransferMock;

    /**
     * @var \Spryker\Zed\Payment\Dependency\Plugin\Checkout\CheckoutSaveOrderPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)->disableOriginalConstructor()->getMock();
        $this->checkoutResponseTransferMock = $this->getMockBuilder(CheckoutResponseTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class extends PrepaymentSaveOrderPlugin {
        };
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->plugin->execute($this->quoteTransferMock, $this->checkoutResponseTransferMock);
    }
}
