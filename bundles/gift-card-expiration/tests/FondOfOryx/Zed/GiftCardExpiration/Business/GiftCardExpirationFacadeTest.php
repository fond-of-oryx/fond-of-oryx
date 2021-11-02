<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidatorInterface;

class GiftCardExpirationFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Business\GiftCardExpirationBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidatorInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $giftCardInvalidatorMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Business\GiftCardExpirationFacade
     */
    protected $facade;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(GiftCardExpirationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardInvalidatorMock = $this->getMockBuilder(GiftCardInvalidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new GiftCardExpirationFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpireGiftCards(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createGiftCardInvalidator')
            ->willReturn($this->giftCardInvalidatorMock);

        $this->giftCardInvalidatorMock->expects(static::atLeastOnce())
            ->method('invalidate');

        $this->facade->expireGiftCards();
    }
}
