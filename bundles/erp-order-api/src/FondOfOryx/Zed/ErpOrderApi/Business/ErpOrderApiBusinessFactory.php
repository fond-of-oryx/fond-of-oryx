<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business;

use FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApi;
use FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApiInterface;
use FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidator;
use FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidatorInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig getConfig()
 */
class ErpOrderApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApiInterface
     */
    public function createErpOrderApi(): ErpOrderApiInterface
    {
        return new ErpOrderApi(
            $this->getApiQueryContainer(),
            $this->getErpOrderFacade(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface
     */
    protected function getApiQueryContainer(): ErpOrderApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface
     */
    protected function getErpOrderFacade(): ErpOrderApiToErpOrderFacadeInterface
    {
        return $this->getProvidedDependency(ErpOrderApiDependencyProvider::FACADE_ERP_ORDER);
    }

    /**
     * @return \FondOfOryx\Zed\ErpOrderApi\Business\Validator\ErpOrderApiValidatorInterface
     */
    public function createErpOrderApiValidator(): ErpOrderApiValidatorInterface
    {
        return new ErpOrderApiValidator();
    }
}
