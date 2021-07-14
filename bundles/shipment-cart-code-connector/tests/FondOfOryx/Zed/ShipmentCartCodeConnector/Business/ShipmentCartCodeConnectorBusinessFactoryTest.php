<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizer;

class ShipmentCartCodeConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factory = new ShipmentCartCodeConnectorBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateShipmentSanitizer(): void
    {
        static::assertInstanceOf(ShipmentSanitizer::class, $this->factory->createShipmentSanitizer());
    }
}
