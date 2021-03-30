<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    public function createCompanyUnitAddressReader()
    {
        return new CompanyUnitAddressReader($this->getRepository());
    }

    /**
     * @return ReturnLabelsRestApiToCompanyAddressApiFacadeInterface
     */
    public function getCompanyUnitAddressApiFacade(): ReturnLabelsRestApiToCompanyAddressApiFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::COMPANY_UNIT_ADDRESS_API_FACADE);
    }
}
