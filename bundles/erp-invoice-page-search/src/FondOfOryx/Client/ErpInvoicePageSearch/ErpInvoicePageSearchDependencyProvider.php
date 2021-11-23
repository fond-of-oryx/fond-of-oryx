<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

/**
 * Class ErpInvoicePageSearchDependencyProvider
 *
 * @package FondOfOryx\Client\ErpInvoicePageSearch
 */
class ErpInvoicePageSearchDependencyProvider extends AbstractDependencyProvider
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
    public const CLIENT_ERP_INVOICE_PERMISSION = 'CLIENT_ERP_INVOICE_PERMISSION';

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
        $container = $this->addErpInvoicePermissionClient($container);
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
            return new ErpInvoicePageSearchToSearchClientBridge(
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
            return new ErpInvoicePageSearchToCustomerClientBridge($container->getLocator()->customer()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addErpInvoicePermissionClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_INVOICE_PERMISSION] = static function (Container $container) {
            return new ErpInvoicePageSearchToErpInvoicePermissionClientBridge(
                $container->getLocator()->erpInvoicePermission()->client(),
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
            return new ErpInvoicePageSearchQueryPlugin();
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
