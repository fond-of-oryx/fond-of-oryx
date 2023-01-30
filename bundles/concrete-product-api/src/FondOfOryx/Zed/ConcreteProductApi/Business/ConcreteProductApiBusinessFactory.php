<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business;

use FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApi;
use FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApiInterface;
use FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidator;
use FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidatorInterface;
use FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiDependencyProvider;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeInterface;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\QueryContainer\ConcreteProductApiToApiQueryBuilderQueryContainerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ConcreteProductApi\ConcreteProductApiConfig getConfig()
 * @method \FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepositoryInterface getRepository()
 */
class ConcreteProductApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ConcreteProductApi\Business\Model\ConcreteProductApiInterface
     */
    public function createConcreteProductApi(): ConcreteProductApiInterface
    {
        return new ConcreteProductApi(
            $this->getApiFacade(),
            $this->getProductFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface
     */
    protected function getProductFacade(): ConcreteProductApiToProductFacadeInterface
    {
        return $this->getProvidedDependency(ConcreteProductApiDependencyProvider::FACADE_PRODUCT);
    }

    /**
     * @return \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeInterface
     */
    protected function getApiFacade(): ConcreteProductApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(ConcreteProductApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\ConcreteProductApi\Dependency\QueryContainer\ConcreteProductApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer(): ConcreteProductApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(ConcreteProductApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\ConcreteProductApi\Business\Validator\ConcreteProductApiValidatorInterface
     */
    public function createConcreteProductApiValidator(): ConcreteProductApiValidatorInterface
    {
        return new ConcreteProductApiValidator();
    }
}
