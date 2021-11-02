<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;

class ProductLocaleRestrictionStorageConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig
     */
    protected $productLocaleRestrictionStorageConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionStorageConfig = new ProductLocaleRestrictionStorageConfig();
    }

    /**
     * @return void
     */
    public function testIsSendingToQueue(): void
    {
        static::assertTrue($this->productLocaleRestrictionStorageConfig->isSendingToQueue());
    }

    /**
     * @return void
     */
    public function testGetProductAbstractLocaleRestrictionSynchronizationPoolName(): void
    {
        static::assertEquals(
            null,
            $this->productLocaleRestrictionStorageConfig->getProductAbstractLocaleRestrictionSynchronizationPoolName(),
        );
    }

    /**
     * @return void
     */
    public function testGetProductAbstractLocaleRestrictionEventQueueName(): void
    {
        static::assertEquals(
            null,
            $this->productLocaleRestrictionStorageConfig->getProductAbstractLocaleRestrictionEventQueueName(),
        );
    }
}
