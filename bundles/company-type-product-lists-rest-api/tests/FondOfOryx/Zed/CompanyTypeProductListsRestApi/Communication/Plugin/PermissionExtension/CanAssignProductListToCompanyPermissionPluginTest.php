<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class CanAssignProductListToCompanyPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Communication\Plugin\PermissionExtension\CanAssignProductListToCompanyPermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new CanAssignProductListToCompanyPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(CanAssignProductListToCompanyPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
