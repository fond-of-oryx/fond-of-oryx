<?php

namespace FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Plugin\CheckoutExtension;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorClient;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\QuoteValidationResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

class ProductCountryRestrictionCheckoutPreCheckPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteValidationResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteValidationResponseTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\ProductCountryRestrictionCheckoutConnectorClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Client\ProductCountryRestrictionCheckoutConnector\Plugin\CheckoutExtension\ProductCountryRestrictionCheckoutPreCheckPlugin
     */
    protected $productCountryRestrictionCheckoutPreCheckPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationResponseTransferMock = $this->getMockBuilder(QuoteValidationResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(ProductCountryRestrictionCheckoutConnectorClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        if (method_exists(ProductCountryRestrictionCheckoutPreCheckPlugin::class, 'setClient')) {
            $this->productCountryRestrictionCheckoutPreCheckPlugin = new ProductCountryRestrictionCheckoutPreCheckPlugin();
            $this->productCountryRestrictionCheckoutPreCheckPlugin->setClient($this->clientMock);
        } else {
            $this->productCountryRestrictionCheckoutPreCheckPlugin = new class ($this->clientMock) extends ProductCountryRestrictionCheckoutPreCheckPlugin {
                /**
                 * @var \Spryker\Client\Kernel\AbstractClient
                 */
                protected $productCountryRestrictionCheckoutConnectorClient;

                /**
                 * @param \Spryker\Client\Kernel\AbstractClient $client
                 */
                public function __construct(AbstractClient $client)
                {
                    $this->productCountryRestrictionCheckoutConnectorClient = $client;
                }

                /**
                 * @return \Spryker\Client\Kernel\AbstractClient
                 */
                protected function getClient(): AbstractClient
                {
                    return $this->productCountryRestrictionCheckoutConnectorClient;
                }
            };
        }
    }

    /**
     * @return void
     */
    public function testIsValid(): void
    {
        $this->clientMock->expects(static::atLeastOnce())
            ->method('validateQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteValidationResponseTransferMock);

        static::assertEquals(
            $this->quoteValidationResponseTransferMock,
            $this->productCountryRestrictionCheckoutPreCheckPlugin->isValid($this->quoteTransferMock),
        );
    }
}
