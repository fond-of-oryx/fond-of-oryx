<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * Class ErpDeliveryNotePageSearchDependencyProvider
 *
 * @package FondOfOryx\Client\ErpDeliveryNotePageSearch
 */
class ErpDeliveryNotePageSearchDependencyProvider extends AbstractDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';

    /**
     * @var string
     */
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';

    /**
     * @var string
     */
    public const CLIENT_ERP_DELIVERY_NOTE_PERMISSION = 'CLIENT_ERP_DELIVERY_NOTE_PERMISSION';

    /**
     * @var string
     */
    public const PLUGIN_SEARCH_QUERY = 'PLUGIN_SEARCH_QUERY';

    /**
     * @var string
     */
    public const PLUGINS_SEARCH_RESULT_FORMATTER = 'PLUGINS_SEARCH_RESULT_FORMATTER';

    /**
     * @var string
     */
    public const PLUGINS_SEARCH_QUERY_EXPANDER = 'PLUGINS_SEARCH_QUERY_EXPANDER';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);

        $container = $this->addSearchClient($container);
        $container = $this->addCustomerClient($container);
        $container = $this->addErpDeliveryNotePermissionClient($container);
        $container = $this->addSearchQueryPlugin($container);
        $container = $this->addResultFormatterPlugins($container);
        $container = $this->addQueryExpanderPlugins($container);

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
            return new ErpDeliveryNotePageSearchToSearchClientBridge(
                $container->getLocator()->search()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCustomerClient(Container $container): Container
    {
        $container[static::CLIENT_CUSTOMER] = static function (Container $container) {
            return new ErpDeliveryNotePageSearchToCustomerClientBridge($container->getLocator()->customer()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addErpDeliveryNotePermissionClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_DELIVERY_NOTE_PERMISSION] = static function (Container $container) {
            return new ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge(
                $container->getLocator()->erpDeliveryNotePermission()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchQueryPlugin(Container $container): Container
    {
        $container[static::PLUGIN_SEARCH_QUERY] = static function () {
            return new ErpDeliveryNotePageSearchQueryPlugin();
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
     * @return array<\Spryker\Client\Search\Dependency\Plugin\ResultFormatterPluginInterface>
     */
    protected function getResultFormatterPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addQueryExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_SEARCH_QUERY_EXPANDER] = static function () use ($self) {
            return $self->getQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface>
     */
    protected function getQueryExpanderPlugins(): array
    {
        return [];
    }
}
