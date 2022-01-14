<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business;

use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersister;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersisterInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReader;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\CustomerBrandProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CustomerBrandProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersisterInterface
     */
    public function createCustomerBrandRelationPersister(): CustomerBrandRelationPersisterInterface
    {
        return new CustomerBrandRelationPersister(
            $this->createBrandReader(),
            $this->getBrandCustomerFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface
     */
    protected function createBrandReader(): BrandReaderInterface
    {
        return new BrandReader(
            $this->getBrandProductListConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface
     */
    protected function getBrandProductListConnectorFacade(): CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(
            CustomerBrandProductListConnectorDependencyProvider::FACADE_BRAND_PRODUCT_LIST_CONNECTOR,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface
     */
    protected function getBrandCustomerFacade(): CustomerBrandProductListConnectorToBrandCustomerFacadeInterface
    {
        return $this->getProvidedDependency(
            CustomerBrandProductListConnectorDependencyProvider::FACADE_BRAND_CUSTOMER,
        );
    }
}
