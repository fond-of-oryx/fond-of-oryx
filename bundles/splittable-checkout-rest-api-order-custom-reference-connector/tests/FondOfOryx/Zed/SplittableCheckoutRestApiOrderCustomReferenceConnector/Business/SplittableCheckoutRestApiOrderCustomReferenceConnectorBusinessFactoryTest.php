<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\Expander\QuoteExpanderInterface;

class SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferenceConnector\Business\SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactory = new SplittableCheckoutRestApiOrderCustomReferenceConnectorBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        static::assertInstanceOf(
            QuoteExpanderInterface::class,
            $this->businessFactory->createQuoteExpander()
        );
    }
}
