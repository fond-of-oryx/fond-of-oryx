<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business;

use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApiInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidatorInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApiInterface
     */
    public function createCompanyBusinessUnitApi(): CompanyBusinessUnitApiInterface
    {
        return new CompanyBusinessUnitApi(
            $this->getApiFacade(),
            $this->getCompanyBusinessUnitFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface
     */
    protected function getApiFacade(): CompanyBusinessUnitApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected function getCompanyBusinessUnitFacade(): CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitApiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidatorInterface
     */
    public function createCompanyBusinessUnitApiValidator(): CompanyBusinessUnitApiValidatorInterface
    {
        return new CompanyBusinessUnitApiValidator();
    }
}
