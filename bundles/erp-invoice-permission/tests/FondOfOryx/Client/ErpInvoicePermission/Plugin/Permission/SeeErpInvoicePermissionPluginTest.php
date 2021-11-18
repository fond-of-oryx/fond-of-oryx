<?php

namespace FondOfOryx\Client\ErpInvoicePermission\Plugin\Permission;

use Codeception\Test\Unit;

class SeeErpInvoicePermissionPluginTest extends Unit
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

        $this->plugin = new SeeErpInvoicesPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(SeeErpInvoicesPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
