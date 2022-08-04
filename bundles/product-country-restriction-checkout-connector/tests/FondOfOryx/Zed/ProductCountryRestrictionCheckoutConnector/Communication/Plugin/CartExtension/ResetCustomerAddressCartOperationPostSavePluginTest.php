<?php

namespace FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacade;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class ResetCustomerAddressCartOperationPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Communication\Plugin\CartExtension\ResetCustomerAddressCartOperationPostSavePlugin
     */
    protected $plugin;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestrictionCheckoutConnector\Business\ProductCountryRestrictionCheckoutConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productCountryRestrictionCheckoutConnectorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productCountryRestrictionCheckoutConnectorFacadeMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ResetCustomerAddressCartOperationPostSavePlugin();
        $this->plugin->setFacade($this->productCountryRestrictionCheckoutConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->productCountryRestrictionCheckoutConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->willReturn($this->quoteValidationResponseTransferMock);

        $this->quoteValidationResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->quoteTransferMock->expects(static::never())->method('getItems');
        $this->quoteTransferMock->expects(static::never())->method('setBillingAddress');

        static::assertEquals($this->plugin->postSave($this->quoteTransferMock), $this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testPostSaveAddressReset(): void
    {
        $this->productCountryRestrictionCheckoutConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->willReturn($this->quoteValidationResponseTransferMock);

        $this->quoteValidationResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn([$this->itemTransferMock]);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with(null)
            ->willReturnSelf();

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with(null)
            ->willReturnSelf();

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with(null)
            ->willReturnSelf();

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingSameAsShipping')
            ->with(null)
            ->willReturnSelf();

        $quoteTransfer = $this->plugin->postSave($this->quoteTransferMock);

        static::assertEquals($quoteTransfer, $this->quoteTransferMock);
        static::assertNull($quoteTransfer->getBillingAddress());
        static::assertNull($quoteTransfer->getShippingAddress());
        static::assertNull($quoteTransfer->getBillingSameAsShipping());
    }
}
