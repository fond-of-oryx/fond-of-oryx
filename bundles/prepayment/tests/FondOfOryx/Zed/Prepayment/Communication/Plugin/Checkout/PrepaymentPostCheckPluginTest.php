<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Checkout;

use Codeception\Test\Unit;
use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class PrepaymentPostCheckPluginTest extends Unit
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
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $billingAddressMock;

    /**
     * @var \Spryker\Zed\Payment\Dependency\Plugin\Checkout\CheckoutPostCheckPluginInterface
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
        $this->billingAddressMock = $this->getMockBuilder(AddressTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class extends PrepaymentPostCheckPlugin {
        };
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->quoteTransferMock->expects(static::once())->method('requireBillingAddress')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('getBillingAddress')->willReturn($this->billingAddressMock);
        $this->billingAddressMock->expects(static::once())->method('requireLastName')->willReturn($this->billingAddressMock);
        $this->billingAddressMock->expects(static::once())->method('getLastName')->willReturn('Tester');
        $this->checkoutResponseTransferMock->expects(static::never())->method('addError');

        $this->plugin->execute($this->quoteTransferMock, $this->checkoutResponseTransferMock);
    }

    /**
     * @return void
     */
    public function testExecuteWillFail(): void
    {
        $this->quoteTransferMock->expects(static::once())->method('requireBillingAddress')->willReturn($this->quoteTransferMock);
        $this->quoteTransferMock->expects(static::once())->method('getBillingAddress')->willReturn($this->billingAddressMock);
        $this->billingAddressMock->expects(static::once())->method('requireLastName')->willReturn($this->billingAddressMock);
        $this->billingAddressMock->expects(static::once())->method('getLastName')->willReturn(PrepaymentConstants::LAST_NAME_FOR_INVALID_TEST);
        $this->checkoutResponseTransferMock->expects(static::once())->method('addError')->willReturn($this->checkoutResponseTransferMock);
        $this->checkoutResponseTransferMock->expects(static::once())->method('setIsSuccess')->willReturn($this->checkoutResponseTransferMock);

        $this->plugin->execute($this->quoteTransferMock, $this->checkoutResponseTransferMock);
    }
}
