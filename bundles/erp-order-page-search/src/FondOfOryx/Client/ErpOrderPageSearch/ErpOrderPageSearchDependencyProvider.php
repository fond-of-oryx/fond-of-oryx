<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * Class ErpOrderPageSearchDependencyProvider
 *
 * @package FondOfOryx\Client\ErpOrderPageSearch
 */
class ErpOrderPageSearchDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_ZED_REQUEST = 'CLIENT_ZED_REQUEST';
    public const CLIENT_SESSION = 'CLIENT_SESSION';
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const PLUGIN_SEARCH_QUERY = 'PLUGIN_SEARCH_QUERY';
    public const PLUGINS_SEARCH_RESULT_FORMATTER = 'PLUGINS_SEARCH_RESULT_FORMATTER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addZedRequestClient($container);
        $container = $this->addSessionClient($container);
        $container = $this->addSearchClient($container);
        $container = $this->addSearchQueryPlugin($container);
        $container = $this->addResultFormatterPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchClient(Container $container): Container
    {
        $container[static::CLIENT_SEARCH] = static function (Container $container) {
            return new ErpOrderPageSearchToSearchClientBridge(
                $container->getLocator()->search()->client()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    protected function addZedRequestClient(Container $container): void
    {
        $container[static::CLIENT_ZED_REQUEST] = static function (Container $container) {
            return $container->getLocator()->zedRequest()->client();
        };
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return void
     */
    private function addSessionClient(Container $container): void
    {
        $container[static::CLIENT_SESSION] = static function (Container $container) {
            return $container->getLocator()->session()->client();
        };
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchQueryPlugin(Container $container): Container
    {
        $container[static::PLUGIN_SEARCH_QUERY] = static function () {
            return new ErpOrderPageSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addResultFormatterPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_RESULT_FORMATTER] = static function () use ($self) {
            return $self->getResultFormatterPlugins();
        };

        return $container;
    }

    /**
     * @return \Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface[]
     */
    protected function getResultFormatterPlugins(): array
    {
        return [];
    }
}
