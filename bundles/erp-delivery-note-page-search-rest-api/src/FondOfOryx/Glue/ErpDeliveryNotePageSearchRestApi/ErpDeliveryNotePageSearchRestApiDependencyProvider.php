<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi;

use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ErpDeliveryNotePageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_ERP_DELIVERY_NOTE_PAGE_SEARCH = 'CLIENT_ERP_DELIVERY_NOTE_PAGE_SEARCH';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);
        $container = $this->addErpDeliveryNotePageSearchClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addErpDeliveryNotePageSearchClient(Container $container): Container
    {
        $container[static::CLIENT_ERP_DELIVERY_NOTE_PAGE_SEARCH] = static function (Container $container) {
            return new ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridge($container->getLocator()->erpDeliveryNotePageSearch()->client());
        };

        return $container;
    }
}
