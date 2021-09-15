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

        $this->plugin = new AlterCartWithoutLimitPermissionPlugin();
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
        static::assertSame(AlterCartWithoutLimitPermissionPlugin::KEY, $this->plugin->getKey());
    }
}
