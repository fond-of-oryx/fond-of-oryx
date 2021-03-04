<?php

namespace FondOfOryx\Glue\ErpOrderPermission\Plugin\Permission;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPermission\Plugin\Permission\SeeErpOrdersPermissionPlugin;

class SeeErpOrderPermissionPluginTest extends Unit
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

        $this->plugin = new SeeErpOrdersPermissionPlugin();
    }

    /**
     * @return void
     */
    public function testGetConfigurationSignature(): void
    {
        $this->assertIsArray($this->plugin->getConfigurationSignature());
        $this->assertSame([], $this->plugin->getConfigurationSignature());
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        $this->assertSame(SeeErpOrdersPermissionPlugin::KEY, $this->plugin->getKey());
    }

    /**
     * @return void
     */
    public function testCanWithIntAsContext(): void
    {
        $this->assertFalse($this->plugin->can([], 1));
    }

    /**
     * @return void
     */
    public function testCanWithNoIntAsContext(): void
    {
        $this->assertFalse($this->plugin->can([], []));
    }

    /**
     * @return void
     */
    public function testCanWithIntAsContextAndReturnTrue(): void
    {
        $config = [
            SeeErpOrdersPermissionPlugin::FIELD_ID_COMPANIES => [1, 2, 3, 4],
        ];

        $this->assertTrue($this->plugin->can($config, 1));
    }
}
