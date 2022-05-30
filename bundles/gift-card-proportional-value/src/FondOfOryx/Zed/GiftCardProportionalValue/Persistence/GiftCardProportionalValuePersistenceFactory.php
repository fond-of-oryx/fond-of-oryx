<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence;

use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\Propel\Mapper\ProportionalGiftCardValueMapper;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValueQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValueRepositoryInterface getRepository()
 */
class GiftCardProportionalValuePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValueQuery
     */
    public function createProportionalGiftCardValueQuery(): FooProportionalGiftCardValueQuery
    {
        return FooProportionalGiftCardValueQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface
     */
    public function createProportionalGiftCardValueMapper(): ProportionalGiftCardValueMapperInterface
    {
        return new ProportionalGiftCardValueMapper();
    }
}
