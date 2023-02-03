<?php

namespace FondOfOryx\Zed\StockProductApi\Business;

use FondOfOryx\Zed\StockProductApi\Business\Mapper\TransferMapper;
use FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReader;
use FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReaderInterface;
use FondOfOryx\Zed\StockProductApi\Business\Model\StockProductApi;
use FondOfOryx\Zed\StockProductApi\Business\Model\Validator\StockProductApiValidator;
use FondOfOryx\Zed\StockProductApi\StockProductApiDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\StockProductApi\StockProductApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainer getQueryContainer()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface getRepository()
 */
class StockProductApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\StockProductApi\Business\Model\StockProductApiInterface
     */
    public function createStockProductApi()
    {
        return new StockProductApi(
            $this->getApiFacade(),
            $this->createTransferMapper(),
            $this->getStockFacade(),
            $this->createStockReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReaderInterface
     */
    public function createStockReader(): StockReaderInterface
    {
        return new StockReader(
            $this->getStockFacade(),
            $this->getApiFacade(),
            $this->getApiQueryBuilderQueryContainer(),
            $this->getQueryContainer(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Business\Mapper\TransferMapperInterface
     */
    public function createTransferMapper()
    {
        return new TransferMapper();
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Business\Model\Validator\StockProductApiValidatorInterface
     */
    public function createStockProductApiValidator()
    {
        return new StockProductApiValidator();
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface
     */
    protected function getApiFacade()
    {
        return $this->getProvidedDependency(StockProductApiDependencyProvider::FACADE_API);
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Dependency\QueryContainer\StockProductApiToApiQueryBuilderQueryContainerInterface
     */
    protected function getApiQueryBuilderQueryContainer()
    {
        return $this->getProvidedDependency(StockProductApiDependencyProvider::QUERY_CONTAINER_API_QUERY_BUILDER);
    }

    /**
     * @return \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface
     */
    protected function getStockFacade()
    {
        return $this->getProvidedDependency(StockProductApiDependencyProvider::FACADE_STOCK);
    }
}
