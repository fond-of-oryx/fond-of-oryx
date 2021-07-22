<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Generated\Shared\Transfer\GiftCardTransfer;
use Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface;

class JellyfishGiftCardToGiftCardFacadeBridge implements JellyfishGiftCardToGiftCardFacadeInterface
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
     * @return \Generated\Shared\Transfer\GiftCardTransfer|null
     */
    public function findGiftCardByIdSalesOrderItem(int $idSalesOrderItem): ?GiftCardTransfer
    {
        return $this->giftCardFacade->findGiftCardByIdSalesOrderItem($idSalesOrderItem);
    }
}
