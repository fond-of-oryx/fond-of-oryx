<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension;

use Codeception\Test\Unit;

class DefineDeliveryDatePermissionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\DeliveryDateRestriction\Communication\Plugin\PermissionExtension\DefineDeliveryDatePermissionPlugin
     */
    protected $plugin;

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var int
     */
    protected $context;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configuration = [
            'id_companies' => [1],
        ];

        $this->context = 1;

        $this->plugin = new DefineDeliveryDatePermissionPlugin();
    }

    /**
     * @return void
     */
    public function testCanTrue(): void
    {
        static::assertTrue($this->plugin->can($this->configuration, $this->context));
    }

    /**
     * @return void
     */
    public function testCanEmptyConfiguration(): void
    {
        static::assertFalse($this->plugin->can([], $this->context));
    }

    /**
     * @return void
     */
    public function testCanContextNull(): void
    {
        static::assertFalse($this->plugin->can($this->configuration));
    }

    /**
     * @return void
     */
    public function testGetConfigurationSignature(): void
    {
        static::assertIsArray($this->plugin->getConfigurationSignature());
    }

    /**
     * @return void
     */
    public function testGetKey(): void
    {
        static::assertSame(DefineDeliveryDatePermissionPlugin::KEY, $this->plugin->getKey());
    }
}
