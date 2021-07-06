<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence;

use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapper;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface getRepository()
 */
class ThirtyFiveUpApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface]
     */
    public function createTransferMapper(): TransferMapperInterface
    {
        return new TransferMapper();
    }

    /**
     * @return \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery
     */
    public function getThirtyFiveUpOrderQuery(): FooThirtyFiveUpOrderQuery
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_THIRTY_FIVE_UP_ORDER);
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface
     */
    public function getQueryBuilderContainer(): ThirtyFiveUpApiToApiQueryBuilderContainerInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_BUILDER_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface
     */
    public function getQueryContainer(): ThirtyFiveUpApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
     */
    public function getThirtyFiveUpFacade(): ThirtyFiveUpApiToThirtyFiveUpFacadeInterface
    {
        return $this->getProvidedDependency(ThirtyFiveUpApiDependencyProvider::FACADE_THIRTY_FIVE_UP);
    }
}
