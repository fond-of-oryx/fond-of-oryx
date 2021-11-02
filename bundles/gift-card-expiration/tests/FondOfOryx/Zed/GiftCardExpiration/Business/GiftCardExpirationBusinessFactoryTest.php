<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidator;
use FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig;
use FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManager;

class GiftCardExpirationBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManager|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Business\GiftCardExpirationBusinessFactory
     */
    protected $factory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(GiftCardExpirationEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(GiftCardExpirationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GiftCardExpirationBusinessFactory();
        $this->factory->setEntityManager($this->entityManagerMock);
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardInvalidator(): void
    {
        static::assertInstanceOf(GiftCardInvalidator::class, $this->factory->createGiftCardInvalidator());
    }
}
