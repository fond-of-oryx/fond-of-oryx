<?php

namespace FondOfOryx\Zed\GiftCardApi\Persistence;

use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerInterface;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerInterface;
use FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerInterface;
use FondOfOryx\Zed\GiftCardApi\GiftCardApiDependencyProvider;
use FondOfOryx\Zed\GiftCardApi\Persistence\Propel\Mapper\GiftCardMapper;
use FondOfOryx\Zed\GiftCardApi\Persistence\Propel\Mapper\GiftCardMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiPersistenceFactory getFactory()
 * @method \FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig getConfig()
 * @method \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface getRepository()
 */
class GiftCardApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Persistence\Propel\Mapper\GiftCardMapperInterface
     */
    public function createGiftCardMapper(): GiftCardMapperInterface
    {
        return new GiftCardMapper();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToGiftCardQueryContainerInterface
     */
    public function getGiftCardQueryContainer(): GiftCardApiToGiftCardQueryContainerInterface
    {
        return $this->getProvidedDependency(GiftCardApiDependencyProvider::QUERY_CONTAINER_GIFT_CARD);
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryContainerInterface
     */
    public function getApiQueryContainer(): GiftCardApiToApiQueryContainerInterface
    {
        return $this->getProvidedDependency(GiftCardApiDependencyProvider::QUERY_CONTAINER_API);
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer\GiftCardApiToApiQueryBuilderContainerInterface
     */
    public function getQueryBuilderContainer(): GiftCardApiToApiQueryBuilderContainerInterface
    {
        return $this->getProvidedDependency(GiftCardApiDependencyProvider::QUERY_BUILDER_CONTAINER_API);
    }
}
