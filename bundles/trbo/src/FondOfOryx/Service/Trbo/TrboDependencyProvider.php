<?php

namespace FondOfOryx\Service\Trbo;

use GuzzleHttp\Client;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;

class TrboDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const HTTP_CLIENT = 'HTTP_CLIENT';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container): Container
    {
        $container = parent::provideServiceDependencies($container);
        $container = $this->addHttpClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addHttpClient(Container $container): Container
    {
        $container[static::HTTP_CLIENT] = static function () {
            return new Client();
        };

        return $container;
    }
}
