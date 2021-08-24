<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Business\Invalidator;

use DateTime;
use FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig;
use FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface;

class GiftCardInvalidator implements GiftCardInvalidatorInterface
{
    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\GiftCardExpiration\Persistence\GiftCardExpirationEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\GiftCardExpiration\GiftCardExpirationConfig $config
     */
    public function __construct(
        GiftCardExpirationEntityManagerInterface $entityManager,
        GiftCardExpirationConfig $config
    ) {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    /**
     * @return void
     */
    public function invalidate(): void
    {
        $createdAt = new DateTime();
        $createdAt->modify(sprintf('-%s days', $this->config->getExpirationPeriod()));
        $createdAt->setTime(0, 0);

        $this->entityManager->expireGiftCardsByCreatedAt($createdAt);
    }
}
