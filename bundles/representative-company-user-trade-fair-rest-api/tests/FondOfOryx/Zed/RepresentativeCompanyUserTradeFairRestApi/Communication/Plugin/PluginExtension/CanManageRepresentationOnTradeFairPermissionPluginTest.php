<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class CanManageRepresentationOnTradeFairPermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Communication\Plugin\PermissionExtension\CanManageRepresentationOnTradeFairPermissionPlugin
     */
    protected CanManageRepresentationOnTradeFairPermissionPlugin $permissionPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->permissionPlugin = new CanManageRepresentationOnTradeFairPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertEquals(
            $this->permissionPlugin->getKey(),
            CanManageRepresentationOnTradeFairPermissionPlugin::KEY,
        );
    }
}
