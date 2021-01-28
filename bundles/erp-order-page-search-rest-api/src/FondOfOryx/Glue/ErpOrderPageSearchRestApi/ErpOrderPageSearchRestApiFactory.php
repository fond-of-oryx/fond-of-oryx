<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReader;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ErpOrderPageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Model\Reader\ErpOrderPageSearchReaderInterface
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createErpOrderReader(): ErpOrderPageSearchReaderInterface
    {
        return new ErpOrderPageSearchReader($this->getErpOrderPageSearchClient());
    }

    /**
     * @return \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface
     * @throws \Spryker\Glue\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getErpOrderPageSearchClient(): ErpOrderPageSearchClientInterface
    {
        return $this->getProvidedDependency(ErpOrderPageSearchRestApiDependencyProvider::CLIENT_ERP_ORDER_PAGE_SEARCH);
    }

}
