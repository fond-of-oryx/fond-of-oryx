<?php

namespace FondOfOryx\Zed\CustomerApi\Business;

use FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResource;
use FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResourceInterface;
use FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidator;
use FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidatorInterface;
use FondOfOryx\Zed\CustomerApi\CustomerApiDependencyProvider;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerApi\Persistence\CustomerApiRepositoryInterface getRepository()
 */
class CustomerApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerApi\Business\Validator\ApiRequestValidatorInterface
     */
    public function createApiRequestValidator(): ApiRequestValidatorInterface
    {
        return new ApiRequestValidator();
    }

    /**
     * @return \FondOfOryx\Zed\CustomerApi\Business\Resource\CustomerResourceInterface
     */
    public function createCustomerResource(): CustomerResourceInterface
    {
        return new CustomerResource(
            $this->getApiFacade(),
            $this->getCustomerFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface
     */
    protected function getApiFacade(): CustomerApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(CustomerApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToCustomerFacadeInterface
     */
    protected function getCustomerFacade(): CustomerApiToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerApiDependencyProvider::FACADE_CUSTOMER);
    }
}
