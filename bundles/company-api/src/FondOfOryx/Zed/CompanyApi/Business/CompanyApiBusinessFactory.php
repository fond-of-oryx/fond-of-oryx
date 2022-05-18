<?php

namespace FondOfOryx\Zed\CompanyApi\Business;

use FondOfOryx\Zed\CompanyApi\Business\Model\CompanyApi;
use FondOfOryx\Zed\CompanyApi\Business\Model\CompanyApiInterface;
use FondOfOryx\Zed\CompanyApi\Business\Model\Validator\CompanyApiValidator;
use FondOfOryx\Zed\CompanyApi\Business\Model\Validator\CompanyApiValidatorInterface;
use FondOfOryx\Zed\CompanyApi\CompanyApiDependencyProvider;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyApi\CompanyApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface getRepository()
 */
class CompanyApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyApi\Business\Model\CompanyApiInterface
     */
    public function createCompanyApi(): CompanyApiInterface
    {
        return new CompanyApi(
            $this->getApiQueryContainer(),
            $this->getCompanyFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer\CompanyApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface
     */
    protected function getCompanyFacade(): CompanyApiToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyApiDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyApi\Business\Model\Validator\CompanyApiValidatorInterface
     */
    public function createCompanyApiValidator(): CompanyApiValidatorInterface
    {
        return new CompanyApiValidator();
    }
}
