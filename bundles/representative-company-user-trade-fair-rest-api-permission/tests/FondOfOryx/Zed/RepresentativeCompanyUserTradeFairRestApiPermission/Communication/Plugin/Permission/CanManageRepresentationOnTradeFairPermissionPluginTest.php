<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Plugin\Permission\CanManageRepresentationOnTradeFairPermissionPlugin;

class CanManageRepresentationOnTradeFairPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApiPermission\Communication\Plugin\PermissionExtension\CanManageRepresentationOnTradeFairPermissionPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new CanManageRepresentationOnTradeFairPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(CanManageRepresentationOnTradeFairPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
