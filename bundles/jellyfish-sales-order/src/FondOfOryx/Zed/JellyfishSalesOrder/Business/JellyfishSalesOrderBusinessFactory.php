<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business;

use FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapter;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapterInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter\SalesOrderExporter;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter\SalesOrderExporterInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapper;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutor;
use FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderDependencyProvider;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderConfig getConfig()
 */
class JellyfishSalesOrderBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Exporter\SalesOrderExporterInterface
     */
    public function createSalesOrderExporter(): SalesOrderExporterInterface
    {
        return new SalesOrderExporter(
            $this->createJellyfishOrderMapper(),
            $this->createJellyfishOrderItemMapper(),
            $this->createJellyfishSalesOrderPluginExecutor(),
            $this->createSalesOrderAdapter()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new HttpClient([
            'base_uri' => $this->getConfig()->getBaseUri(),
            'timeout' => $this->getConfig()->getTimeout(),
        ]);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderMapperInterface
     */
    protected function createJellyfishOrderMapper(): JellyfishOrderMapperInterface
    {
        return new JellyfishOrderMapper(
            $this->createJellyfishOrderAddressMapper(),
            $this->createJellyfishOrderExpenseMapper(),
            $this->createJellyfishOrderDiscountMapper(),
            $this->createJellyfishOrderPaymentMapper(),
            $this->createJellyfishOrderTotalsMapper(),
            $this->getConfig(),
            $this->getOrderExpanderPostMapPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderAddressMapperInterface
     */
    protected function createJellyfishOrderAddressMapper(): JellyfishOrderAddressMapperInterface
    {
        return new JellyfishOrderAddressMapper(
            $this->getOrderAddressExpanderPostMapPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderExpenseMapperInterface
     */
    protected function createJellyfishOrderExpenseMapper(): JellyfishOrderExpenseMapperInterface
    {
        return new JellyfishOrderExpenseMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderDiscountMapperInterface
     */
    protected function createJellyfishOrderDiscountMapper(): JellyfishOrderDiscountMapperInterface
    {
        return new JellyfishOrderDiscountMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderPaymentMapperInterface
     */
    protected function createJellyfishOrderPaymentMapper(): JellyfishOrderPaymentMapperInterface
    {
        return new JellyfishOrderPaymentMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderTotalsMapperInterface
     */
    protected function createJellyfishOrderTotalsMapper(): JellyfishOrderTotalsMapperInterface
    {
        return new JellyfishOrderTotalsMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper\JellyfishOrderItemMapperInterface
     */
    protected function createJellyfishOrderItemMapper(): JellyfishOrderItemMapperInterface
    {
        return new JellyfishOrderItemMapper(
            $this->getOrderItemExpanderPostMapPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\PluginExecutor\JellyfishSalesOrderPluginExecutorInterface
     */
    protected function createJellyfishSalesOrderPluginExecutor(): JellyfishSalesOrderPluginExecutorInterface
    {
        return new JellyfishSalesOrderPluginExecutor($this->getJellyfishOrderPostMapPlugins());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Business\Api\Adapter\SalesOrderAdapterInterface
     */
    protected function createSalesOrderAdapter(): SalesOrderAdapterInterface
    {
        return new SalesOrderAdapter(
            $this->getUtilEncodingService(),
            $this->createHttpClient(),
            $this->getConfig(),
            $this->getOrderBeforeExportPlugins()
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): JellyfishSalesOrderToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface[]
     */
    protected function getOrderAddressExpanderPostMapPlugins(): array
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface[]
     */
    protected function getOrderBeforeExportPlugins(): array
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderExpanderPostMapPluginInterface[]
     */
    protected function getOrderExpanderPostMapPlugins(): array
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderItemExpanderPostMapPluginInterface[]
     */
    protected function getOrderItemExpanderPostMapPlugins(): array
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderPostMapPluginInterface[]
     */
    protected function getJellyfishOrderPostMapPlugins(): array
    {
        return $this->getProvidedDependency(JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_POST_MAP);
    }
}
