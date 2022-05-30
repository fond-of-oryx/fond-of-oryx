<?php

namespace FondOfOryx\Zed\GiftCardProportionalValue\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardProportionalValue\Persistence\Propel\Mapper\ProportionalGiftCardValueMapperInterface;
use Orm\Zed\GiftCardProportionalValue\Persistence\FooProportionalGiftCardValueQuery;

class GiftCardProportionalValuePersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardProportionalValue\Persistence\GiftCardProportionalValuePersistenceFactory
     */
    protected $persistenceFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->persistenceFactory = new GiftCardProportionalValuePersistenceFactory();
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueQuery(): void
    {
        static::assertInstanceOf(
            FooProportionalGiftCardValueQuery::class,
            $this->persistenceFactory->createProportionalGiftCardValueQuery(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProportionalGiftCardValueMapper(): void
    {
        static::assertInstanceOf(
            ProportionalGiftCardValueMapperInterface::class,
            $this->persistenceFactory->createProportionalGiftCardValueMapper(),
        );
    }
}
