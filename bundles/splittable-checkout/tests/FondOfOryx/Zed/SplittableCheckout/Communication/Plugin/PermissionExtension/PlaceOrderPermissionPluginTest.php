<?php

namespace FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class PlaceOrderPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Communication\Plugin\PermissionExtension\PlaceOrderPermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new PlaceOrderPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(PlaceOrderPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
