<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class JellyfishGiftCardRequestMapper implements JellyfishGiftCardRequestMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface
     */
    protected $localeFilter;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface
     */
    protected $giftCardFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface $localeFilter
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface $giftCardFacade
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface $salesFacade
     */
    public function __construct(
        LocaleFilterInterface $localeFilter,
        JellyfishGiftCardToGiftCardFacadeInterface $giftCardFacade,
        JellyfishGiftCardToSalesFacadeInterface $salesFacade
    ) {
        $this->localeFilter = $localeFilter;
        $this->giftCardFacade = $giftCardFacade;
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer
     */
    public function fromSalesOrderItem(SpySalesOrderItem $spySalesOrderItem): JellyfishGiftCardRequestTransfer
    {
        $idSalesOrderItem = $spySalesOrderItem->getIdSalesOrderItem();
        $orderTransfer = $this->salesFacade->findOrderByIdSalesOrderItem($idSalesOrderItem);
        $giftCardTransfer = $this->giftCardFacade->findGiftCardByIdSalesOrderItem($idSalesOrderItem);

        $jellyfishGiftCardRequestTransfer = (new JellyfishGiftCardRequestTransfer())->setGiftCard($giftCardTransfer)
            ->setOrder($orderTransfer);

        if ($orderTransfer === null) {
            return $jellyfishGiftCardRequestTransfer;
        }

        $localeTransfer = $this->localeFilter->fromSpySalesOrderItem($spySalesOrderItem);

        return $jellyfishGiftCardRequestTransfer->setLocale($localeTransfer);
    }
}
