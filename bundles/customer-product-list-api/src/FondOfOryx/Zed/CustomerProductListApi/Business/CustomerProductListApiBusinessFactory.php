<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApi;
use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApiInterface;
use FondOfOryx\Zed\CustomerProductListApi\CustomerProductListApiDependencyProvider;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
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
            $this->getApiFacade(),
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
     * @return \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface
     */
    protected function getApiFacade(): CustomerProductListApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CustomerProductListApiDependencyProvider::FACADE_API);
    }
}
