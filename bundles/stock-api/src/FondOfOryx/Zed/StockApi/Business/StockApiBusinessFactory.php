<?php

namespace FondOfOryx\Zed\StockApi\Business;

use FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReader;
use FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface;
use FondOfOryx\Zed\StockApi\Business\Model\StockApi;
use FondOfOryx\Zed\StockApi\Business\Model\StockApiInterface;
use FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidator;
use FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidatorInterface;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface;
use FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\StockApi\StockApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\StockApi\StockApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer getQueryContainer()
 */
class StockApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\StockApi\Business\Model\StockApiInterface
     */
    public function createStockApi(): StockApiInterface
    {
        return new StockApi(
            $this->createStockReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface
     */
    public function createStockReader(): StockReaderInterface
    {
        return new StockReader(
            $this->getStockFacade(),
            $this->getApiFacade(),
            $this->getApiQueryBuilderQueryContainer(),
            $this->getQueryContainer(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\StockApi\Business\Model\Validator\StockApiValidatorInterface
     */
    public function createStockApiValidator(): StockApiValidatorInterface
    {
        return new StockApiValidator();
    }

    /**
     * @return \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface
     */
    protected function getApiFacade(): StockApiToApiFacadeInterface
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer(): StockApiToApiQueryBuilderQueryContainerInterface
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface
     */
    protected function getStockFacade(): StockApiToStockInterface
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::FACADE_STOCK);
    }
}
