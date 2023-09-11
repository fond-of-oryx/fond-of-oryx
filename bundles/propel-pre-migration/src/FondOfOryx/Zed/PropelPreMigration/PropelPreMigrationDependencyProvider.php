<?php

namespace FondOfOryx\Zed\PropelPreMigration;

use Propel\Runtime\Propel;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManagerInterface getEntityManager()()
 */
class PropelPreMigrationDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_CONNECTION = 'PROPEL_CONNECTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addPropelConnection($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPropelConnection(Container $container): Container
    {
        $container[static::PROPEL_CONNECTION] = static function (Container $container) {
            return Propel::getConnection();
        };

        return $container;
    }
}
