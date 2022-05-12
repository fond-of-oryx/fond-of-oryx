<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use FondOfOryx\Zed\CreditMemoGiftCardConnector\CreditMemoGiftCardConnectorDependencyProvider;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapper;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapperInterface;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCardQuery;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\CreditMemo\CreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface getRepository()
 */
class CreditMemoGiftCardConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCardQuery
     */
    public function createCreditMemoGiftCardQuery(): FooCreditMemoGiftCardQuery
    {
        return FooCreditMemoGiftCardQuery::create();
    }

    /**
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemoQuery
     */
    public function getCreditMemoQuery(): FooCreditMemoQuery
    {
        return $this->getProvidedDependency(CreditMemoGiftCardConnectorDependencyProvider::QUERY_FOO_CREDIT_MEMO);
    }

    /**
     * @return \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapperInterface
     */
    public function createCreditMemoGiftCardMapper(): CreditMemoGiftCardMapperInterface
    {
        return new CreditMemoGiftCardMapper();
    }
}
