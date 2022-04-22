<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence;

use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapper;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapperInterface;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemoGiftCardQuery;
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
     * @return \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\Propel\Mapper\CreditMemoGiftCardMapperInterface
     */
    public function createCreditMemoGiftCardMapper(): CreditMemoGiftCardMapperInterface
    {
        return new CreditMemoGiftCardMapper();
    }
}
