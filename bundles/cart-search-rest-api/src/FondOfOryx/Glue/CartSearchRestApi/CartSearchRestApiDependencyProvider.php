<?php

namespace FondOfOryx\Glue\CartSearchRestApi;

use FondOfOryx\Glue\CartSearchRestApi\Dependency\Client\CartSearchRestApiToGlossaryStorageClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

/**
 * @codeCoverageIgnore
 */
class CartSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
 /**
  * @var string
  */
    public const CLIENT_GLOSSARY_STORAGE = 'CLIENT_GLOSSARY_STORAGE';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        return $this->addGlossaryStorageClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addGlossaryStorageClient(Container $container): Container
    {
        $container[static::CLIENT_GLOSSARY_STORAGE] = static function (Container $container) {
            return new CartSearchRestApiToGlossaryStorageClientBridge(
                $container->getLocator()->glossaryStorage()->client(),
            );
        };

        return $container;
    }
}
