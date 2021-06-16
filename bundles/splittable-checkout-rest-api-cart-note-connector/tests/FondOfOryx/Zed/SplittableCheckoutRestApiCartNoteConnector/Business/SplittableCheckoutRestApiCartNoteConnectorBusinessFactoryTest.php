<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\Expander\QuoteExpanderInterface;

class SplittableCheckoutRestApiCartNoteConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCartNoteConnector\Business\SplittableCheckoutRestApiCartNoteConnectorBusinessFactory
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

        $this->businessFactory = new SplittableCheckoutRestApiCartNoteConnectorBusinessFactory();
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
