<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidator;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiDependencyProvider;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig getConfig()
 * @method \FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface getRepository()
 */
class CompanyUnitAddressApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface
     */
    public function createCompanyUnitAddressApi(): CompanyUnitAddressApiInterface
    {
        return new CompanyUnitAddressApi(
            $this->getApiQueryContainer(),
            $this->getCompanyFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): CompanyUnitAddressApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected function getCompanyFacade(): CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUnitAddressApiDependencyProvider::FACADE_COMPANY_UNIT_ADDRESS);
    }

    /**
     * @return \FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface
     */
    public function createCompanyUnitAddressApiValidator(): CompanyUnitAddressApiValidatorInterface
    {
        return new CompanyUnitAddressApiValidator();
    }
}
