<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class SeeCompanyProductListsPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Communication\Plugin\PermissionExtension\SeeCompanyProductListsPermissionPlugin
     */
    protected SeeCompanyProductListsPermissionPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new SeeCompanyProductListsPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertEquals(
            SeeCompanyProductListsPermissionPlugin::KEY,
            $this->plugin->getKey(),
        );
    }
}
