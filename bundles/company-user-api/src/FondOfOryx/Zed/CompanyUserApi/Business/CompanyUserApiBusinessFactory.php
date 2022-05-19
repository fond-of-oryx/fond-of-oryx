<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business;

use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApiInterface;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidatorInterface;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiDependencyProvider;
use FondOfOryx\Zed\CompanyUserApi\Dependency\Facade\CompanyUserApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface;
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
            $this->getApiQueryContainer(),
            $this->getCompanyUserFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUserApi\Dependency\QueryContainer\CompanyUserApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyUserApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUserApiDependencyProvider::QUERY_CONTAINER_API);
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
