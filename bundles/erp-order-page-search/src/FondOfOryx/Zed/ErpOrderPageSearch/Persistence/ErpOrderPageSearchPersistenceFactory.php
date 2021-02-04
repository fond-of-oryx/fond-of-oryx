<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapper;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\Propel\Mapper\ErpOrderPageSearchMapperInterface;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrderPageSearch\Persistence\FooErpOrderPageSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

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
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getErpOrderPageSearchQuery(): FooErpOrderPageSearchQuery
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER_PAGE_SEARCH);
    }

    /**
     * @return \Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getErpOrderQuery(): ErpOrderQuery
    {
        return $this->getProvidedDependency(ErpOrderPageSearchDependencyProvider::QUERY_ERP_ORDER);
    }
}
