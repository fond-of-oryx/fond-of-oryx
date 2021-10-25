<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class DefineDeliveryDatePermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension\DefineDeliveryDatePermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new DefineDeliveryDatePermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(DefineDeliveryDatePermissionPlugin::KEY, $this->plugin->getKey());
    }
}
