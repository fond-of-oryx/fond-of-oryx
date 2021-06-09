<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander\QuoteExpander;

class SplittableCheckoutRestApiShipmentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\SplittableCheckoutRestApiShipmentConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactory = new SplittableCheckoutRestApiShipmentConnectorBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander()
        );
    }
}
