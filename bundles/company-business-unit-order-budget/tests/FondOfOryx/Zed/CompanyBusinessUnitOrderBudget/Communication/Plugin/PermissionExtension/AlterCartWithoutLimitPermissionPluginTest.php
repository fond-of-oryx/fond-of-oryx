<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class AlterCartWithoutLimitPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Communication\Plugin\PermissionExtension\AlterCartWithoutLimitPermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new AlterCartWithoutLimitPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(AlterCartWithoutLimitPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
