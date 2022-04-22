<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence;

use FondOfOryx\Zed\CreditMemo\CreditMemoDependencyProvider;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemMapper;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemMapperInterface;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemStateMapper;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemStateMapperInterface;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoMapper;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoMapperInterface;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoStateMapper;
use FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoStateMapperInterface;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemQuery;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemStateQuery;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoStateQuery;
use Orm\Zed\Payment\Persistence\SpySalesPaymentQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CreditMemo\CreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface getRepository()
 */
class CreditMemoPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemQuery
     */
    public function createCreditMemoItemQuery(): FooCreditMemoItemQuery
    {
        return FooCreditMemoItemQuery::create();
    }

    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery
     */
    public function createCreditMemoQuery(): FooCreditMemoQuery
    {
        return FooCreditMemoQuery::create();
    }

    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoStateQuery
     */
    public function createCreditMemoStateQuery(): FooCreditMemoStateQuery
    {
        return FooCreditMemoStateQuery::create();
    }

    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoItemStateQuery
     */
    public function createCreditMemoItemStateQuery(): FooCreditMemoItemStateQuery
    {
        return FooCreditMemoItemStateQuery::create();
    }

    /**
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery
     */
    public function getSpySalesPaymentQuery(): SpySalesPaymentQuery
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::QUERY_SALES_PAYMENT);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery
     */
    public function getSpySalesOrderQuery(): SpySalesOrderQuery
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::QUERY_SALES_ORDER);
    }

    /**
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemQuery
     */
    public function getSpySalesOrderItemQuery(): SpySalesOrderItemQuery
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::QUERY_SALES_ORDER_ITEM);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoMapperInterface
     */
    public function createCreditMemoMapper(): CreditMemoMapperInterface
    {
        return new CreditMemoMapper($this->getCreditMemoMapperExpanderPlugins());
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemMapperInterface
     */
    public function createCreditMemoItemMapper(): CreditMemoItemMapperInterface
    {
        return new CreditMemoItemMapper();
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoStateMapperInterface
     */
    public function createCreditMemoStateMapper(): CreditMemoStateMapperInterface
    {
        return new CreditMemoStateMapper();
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper\CreditMemoItemStateMapperInterface
     */
    public function createCreditMemoItemStateMapper(): CreditMemoItemStateMapperInterface
    {
        return new CreditMemoItemStateMapper();
    }

    /**
     * @return array<\FondOfOryx\Zed\CreditMemoExtension\Persistence\Dependency\Plugin\CreditMemoMapperExpanderPluginInterface>
     */
    public function getCreditMemoMapperExpanderPlugins(): array
    {
        return $this->getProvidedDependency(CreditMemoDependencyProvider::PLUGINS_MAPPER_EXPANDER);
    }
}
