<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpander;

class SplittableTotalsRestApiShipmentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactory = new SplittableTotalsRestApiShipmentConnectorBusinessFactory();
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
