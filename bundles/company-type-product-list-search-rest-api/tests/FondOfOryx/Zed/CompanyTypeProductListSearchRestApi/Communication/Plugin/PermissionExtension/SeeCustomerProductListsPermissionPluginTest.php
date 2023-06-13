<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class SeeCustomerProductListsPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Communication\Plugin\PermissionExtension\SeeCustomerProductListsPermissionPlugin
     */
    protected SeeCustomerProductListsPermissionPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new SeeCustomerProductListsPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertEquals(
            SeeCustomerProductListsPermissionPlugin::KEY,
            $this->plugin->getKey(),
        );
    }
}
