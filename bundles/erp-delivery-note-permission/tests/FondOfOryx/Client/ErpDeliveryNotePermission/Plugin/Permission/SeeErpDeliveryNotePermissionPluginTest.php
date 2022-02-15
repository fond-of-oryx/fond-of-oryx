<?php

namespace FondOfOryx\Client\ErpDeliveryNotePermission\Plugin\Permission;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePermission\Communication\Plugin\Permission\SeeErpDeliveryNotesPermissionPlugin;

class SeeErpDeliveryNotePermissionPluginTest extends Unit
{
    /**
     * @var \Spryker\Shared\PermissionExtension\Dependency\Plugin\ExecutablePermissionPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->plugin = new SeeErpDeliveryNotesPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(SeeErpDeliveryNotesPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
