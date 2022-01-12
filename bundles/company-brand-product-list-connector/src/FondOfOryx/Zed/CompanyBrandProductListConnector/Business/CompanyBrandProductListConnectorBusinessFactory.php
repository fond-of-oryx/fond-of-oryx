<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business;

use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersister;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersisterInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReader;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\CompanyBrandProductListConnectorDependencyProvider;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CompanyBrandProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister\CompanyBrandRelationPersisterInterface
     */
    public function createCompanyBrandRelationPersister(): CompanyBrandRelationPersisterInterface
    {
        return new CompanyBrandRelationPersister(
            $this->createBrandReader(),
            $this->getBrandCompanyFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Reader\BrandReaderInterface
     */
    protected function createBrandReader(): BrandReaderInterface
    {
        return new BrandReader(
            $this->getBrandProductListConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface
     */
    protected function getBrandProductListConnectorFacade(): CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_PRODUCT_LIST_CONNECTOR,
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeInterface
     */
    protected function getBrandCompanyFacade(): CompanyBrandProductListConnectorToBrandCompanyFacadeInterface
    {
        return $this->getProvidedDependency(
            CompanyBrandProductListConnectorDependencyProvider::FACADE_BRAND_COMPANY,
        );
    }
}
