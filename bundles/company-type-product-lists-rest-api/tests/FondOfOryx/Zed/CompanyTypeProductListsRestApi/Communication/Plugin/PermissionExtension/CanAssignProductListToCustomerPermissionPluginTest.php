<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class CanAssignProductListToCustomerPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCustomerPermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new CanAssignProductListToCustomerPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(CanAssignProductListToCustomerPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
