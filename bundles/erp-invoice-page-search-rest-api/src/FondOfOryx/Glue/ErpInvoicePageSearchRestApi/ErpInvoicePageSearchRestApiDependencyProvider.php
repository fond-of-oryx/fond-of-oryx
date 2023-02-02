<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi;

use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToGlossaryStorageClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ErpInvoicePageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_ERP_INVOICE_PAGE_SEARCH = 'CLIENT_ERP_INVOICE_PAGE_SEARCH';

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

        $container = $this->addErpInvoicePageSearchClient($container);

        return $this->addGlossaryStorageClient($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addErpInvoicePageSearchClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_INVOICE_PAGE_SEARCH] = static function (Container $container) {
            return new ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge(
                $container->getLocator()->erpInvoicePageSearch()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addGlossaryStorageClient(Container $container): Container
    {
        $container[static::CLIENT_GLOSSARY_STORAGE] = static function (Container $container) {
            return new ErpInvoicePageSearchRestApiToGlossaryStorageClientBridge(
                $container->getLocator()->glossaryStorage()->client(),
            );
        };

        return $container;
    }
}
