<?php

namespace FondOfOryx\Zed\EasyApi;

use FondOfOryx\Zed\EasyApi\Dependency\Client\EasyApiToGuzzleClientBridge;
use GuzzleHttp\Client;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @codeCoverageIgnore
 * @method \FondOfOryx\Zed\EasyApi\EasyApiConfig getConfig()
 */
class EasyApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_GUZZLE = 'CLIENT_GUZZLE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addGuzzleClient($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addGuzzleClient(Container $container): Container
    {
        $container[static::CLIENT_GUZZLE] = function (Container $container) {
            return new EasyApiToGuzzleClientBridge(
                new Client(['base_uri' => $this->getConfig()->getEasyApiUri()]),
            );
        };

        return $container;
    }
}
