<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader\CompanyUnitAddressReaderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Validator\PermissionValidator;
use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Validator\PermissionValidatorInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\ReturnLabelsRestApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Reader\CompanyUnitAddressReaderInterface
     */
    public function createCompanyUnitAddressReader(): CompanyUnitAddressReaderInterface
    {
        return new CompanyUnitAddressReader(
            $this->getCustomerFacade(),
            $this->getCompanyUserFacade(),
            $this->getRepository()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Validator\PermissionValidatorInterface
     */
    public function createPermissionValidator(): PermissionValidatorInterface
    {
        return new PermissionValidator(
            $this->getCustomerFacade()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCustomerFacadeInterface
     */
    public function getCustomerFacade(): ReturnLabelsRestApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\ReturnLabelsRestApiToCompanyUserInterface
     */
    public function getCompanyUserFacade(): ReturnLabelsRestApiToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(ReturnLabelsRestApiDependencyProvider::FACADE_COMPANY_USER);
    }
}
