<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapperInterface;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig getConfig()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepositoryInterface getRepository()
 */
class ErpOrderPageSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapperInterface
     */
    public function createErpOrderPageSearchMapper(): ErpOrderPageSearchMapperInterface
    {
        return new ErpOrderPageSearchMapper();
    }

    /**
     * @return \Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery
     */
    public function getErpOrderPageSearchQuery(): FooErpOrderPageSearchQuery
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER_PAGE_SEARCH);
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    public function getErpOrderQuery(): ErpOrderQuery
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER);
    }
}
