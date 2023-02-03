<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business;

use FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApi;
use FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApiInterface;
use FondOfOryx\Zed\CompanyProductListApi\CompanyProductListApiDependencyProvider;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListApi\CompanyProductListApiConfig getConfig()
 */
class CompanyProductListApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApiInterface
     */
    public function createCompanyProductListApi(): CompanyProductListApiInterface
    {
        return new CompanyProductListApi(
            $this->getCompanyProductListConnnectorFacade(),
            $this->getApiFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface
     */
    protected function getCompanyProductListConnnectorFacade(): CompanyProductListApiToCompanyProductListConnectorFacadeInterface
    {
        return $this->getProvidedDependency(CompanyProductListApiDependencyProvider::FACADE_COMPANY_PRODUCT_LIST_CONNECTOR);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToApiFacadeInterface
     */
    protected function getApiFacade(): CompanyProductListApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyProductListApiDependencyProvider::FACADE_API);
    }
}
