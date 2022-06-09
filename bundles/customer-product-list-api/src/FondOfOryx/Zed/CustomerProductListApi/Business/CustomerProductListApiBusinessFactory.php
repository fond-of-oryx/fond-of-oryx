<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApi;
use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApiInterface;
use FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiConfig getConfig()
 */
class CustomerProductListApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApiInterface
     */
    public function createCustomerProductListApi(): CustomerProductListApiInterface
    {
        return new CustomerProductListApi(
            $this->getCustomerProductListConnnectorFacade(),
            $this->getApiQueryContainer(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface
     */
    protected function getCustomerProductListConnnectorFacade(): CustomerProductListApiToCustomerProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(CustomerProductListApiDependencyProvider::FACADE_CUSTOMER_PRODUCT_LIST_CONNECTOR);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CustomerProductListApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CustomerProductListApiDependencyProvider::QUERY_CONTAINER_API);
    }
}
