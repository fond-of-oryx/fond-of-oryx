<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use FondOfOryx\Zed\Jellyfish\Business\Model\Mapper\JellyfishCreditMemoMapper;
use FondOfOryx\Zed\Jellyfish\Business\Model\Mapper\JellyfishCreditMemoMapperInterface;
use FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoDependencyProvider;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\CompanyRole\CompanyRoleConfig getConfig()
 * @method \Spryker\Zed\CompanyRole\Persistence\CompanyRoleEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface getRepository()
 */
class JellyfishCreditMemoPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery
     */
    public function createCreditMemoQuery(): FooCreditMemoQuery
    {
        return FooCreditMemoQuery::create();
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery
     */
    public function getSalesOrderItemQuery(): SpySalesOrderItemQuery
    {
        return $this->getProvidedDependency(JellyfishCreditMemoDependencyProvider::PROPEL_QUERY_SALES_ORDER_ITEM);
    }
    
    /**
     * @return \FondOfOryx\Zed\Jellyfish\Business\Model\Mapper\JellyfishCreditMemoMapperInterface
     */
    public function createJellyfishCreditMemoMapper(): JellyfishCreditMemoMapperInterface
    {
        return new JellyfishCreditMemoMapper();
    }
}
