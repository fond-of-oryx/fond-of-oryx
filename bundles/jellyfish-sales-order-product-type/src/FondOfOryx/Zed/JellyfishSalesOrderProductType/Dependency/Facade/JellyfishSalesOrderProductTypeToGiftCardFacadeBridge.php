<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade;

use Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface;

class JellyfishSalesOrderProductTypeToGiftCardFacadeBridge implements JellyfishSalesOrderProductTypeToGiftCardFacadeInterface
{
    /**
     * @var \Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface
     */
    protected $giftCardFacade;

    /**
     * @param \Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface $giftCardFacade
     */
    public function __construct(GiftCardFacadeInterface $giftCardFacade)
    {
        $this->giftCardFacade = $giftCardFacade;
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function isGiftCardOrderItem(int $idSalesOrderItem): bool
    {
        return $this->giftCardFacade->isGiftCardOrderItem($idSalesOrderItem);
    }
}
