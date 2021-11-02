<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator;

use Codeception\Test\Unit;
use DateTime;
use FondOfOryx\Shared\GiftCardExpiration\GiftCardExpirationConstants;
use FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig;
use FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface;

class GiftCardInvalidatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator\GiftCardInvalidator
     */
    protected $giftCardInvalidator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GiftCardExpirationConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(GiftCardExpirationEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardInvalidator = new GiftCardInvalidator(
            $this->entityManagerMock,
            $this->configMock,
        );
    }

    /**
     * @return void
     */
    public function testInvalidate(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getExpirationPeriod')
            ->willReturn(GiftCardExpirationConstants::EXPIRATION_PERIOD_DEFAULT);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('expireGiftCardsByCreatedAt')
            ->with(
                static::callback(static function (DateTime $createdAt) {
                    $expectedCreatedAt = new DateTime();
                    $expectedCreatedAt->modify(
                        sprintf('-%s days', GiftCardExpirationConstants::EXPIRATION_PERIOD_DEFAULT),
                    );
                    $expectedCreatedAt->setTime(0, 0);

                    return $createdAt == $expectedCreatedAt;
                }),
            );

        $this->giftCardInvalidator->invalidate();
    }
}
