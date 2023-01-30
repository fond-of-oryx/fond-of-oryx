<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business;

use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApiInterface;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidatorInterface;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUserApi\Persistence\CompanyUserApiRepositoryInterface getRepository()
 */
class CompanyUserApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApiInterface
     */
    public function createCompanyUserApi(): CompanyUserApiInterface
    {
        return new CompanyUserApi(
            $this->getApiFacade(),
            $this->getCompanyUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToApiFacadeInterface
     */
    protected function getApiFacade(): CompanyUserApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): CompanyUserApiToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidatorInterface
     */
    public function createCompanyUserApiValidator(): CompanyUserApiValidatorInterface
    {
        return new CompanyUserApiValidator();
    }
}
