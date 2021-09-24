<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface;
use Generated\Shared\Transfer\JellyfishOrderItemTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpander implements JellyfishOrderExpanderInterface
{
    protected const SALES_PAYMENT_METHOD_GIFT_CARD = 'GiftCard';
    protected const CART_CODE_TYPE_GIFT_CARD = 'gift card';

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface
     */
    protected $productCardCodeTypeRestrictionFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface $productCardCodeTypeRestrictionFacade
     */
    public function __construct(
        JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper,
        JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeInterface $productCardCodeTypeRestrictionFacade
    ) {
        $this->jellyfishOrderGiftCardMapper = $jellyfishOrderGiftCardMapper;
        $this->productCardCodeTypeRestrictionFacade = $productCardCodeTypeRestrictionFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expand(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        SpySalesOrder $salesOrder
    ): JellyfishOrderTransfer {
        $giftCardPayments = $this->getGiftCardPayments($salesOrder);

        if ($giftCardPayments->count() === 0) {
            return $jellyfishOrderTransfer;
        }

        return $jellyfishOrderTransfer
            ->setGiftCards($this->mapSalesPaymentsToGiftCards($giftCardPayments));
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderTransfer
     */
    public function expandOrderItemsWithGiftCardRestrictionFlag(
        JellyfishOrderTransfer $jellyfishOrderTransfer
    ): JellyfishOrderTransfer {
        if ($jellyfishOrderTransfer->getGiftCards()->count() === 0) {
            return $jellyfishOrderTransfer;
        }

        $blacklistedItemsForGiftCard = $this->getBlacklistedGiftCardItems(
            $this->productCardCodeTypeRestrictionFacade
                ->getBlacklistedCartCodeTypesByProductConcreteSkus(
                    $this->getProductConcreteSkus($jellyfishOrderTransfer)
                )
        );

        foreach ($jellyfishOrderTransfer->getItems() as $jellyfishOrderItemTransfer) {
            $jellyfishOrderItemTransfer->setIsBlacklistedForGiftCard(
                $this->isBlacklistedForGiftCard($jellyfishOrderItemTransfer, $blacklistedItemsForGiftCard)
            );
        }

        return $jellyfishOrderTransfer;
    }

    /**
     * @param \ArrayObject $payments
     *
     * @return \ArrayObject
     */
    protected function mapSalesPaymentsToGiftCards(ArrayObject $payments): ArrayObject
    {
        $jellyfishOrderGiftCards = new ArrayObject();

        foreach ($payments as $payment) {
            $jellyfishOrderGiftCards->append(
                $this->jellyfishOrderGiftCardMapper->fromSalesPayment($payment)
            );
        }

        return $jellyfishOrderGiftCards;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function getGiftCardPayments(SpySalesOrder $salesOrder): ArrayObject
    {
        $giftCardPayments = new ArrayObject();

        foreach ($salesOrder->getOrdersJoinSalesPaymentMethodType() as $salesPayment) {
            if (
                $salesPayment->getSalesPaymentMethodType()->getPaymentMethod()
                !== static::SALES_PAYMENT_METHOD_GIFT_CARD
            ) {
                continue;
            }

            $giftCardPayments->append($salesPayment);
        }

        return $giftCardPayments;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @return string[]
     */
    protected function getProductConcreteSkus(JellyfishOrderTransfer $jellyfishOrderTransfer): array
    {
        $skus = [];

        foreach ($jellyfishOrderTransfer->getItems() as $item) {
            $skus[] = $item->getSku();
        }

        return $skus;
    }

    /**
     * @param array $blacklistedItems
     *
     * @return array
     */
    protected function getBlacklistedGiftCardItems(array $blacklistedItems): array
    {
        $blacklistedGiftCardItems = [];

        foreach ($blacklistedItems as $sku => $cartCodeTypes) {
            if (in_array(static::CART_CODE_TYPE_GIFT_CARD, $cartCodeTypes)) {
                $blacklistedGiftCardItems[] = $sku;
            }
        }

        return $blacklistedGiftCardItems;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     * @param array $blacklistedItemsForGiftCard
     *
     * @return bool
     */
    protected function isBlacklistedForGiftCard(
        JellyfishOrderItemTransfer $jellyfishOrderItemTransfer,
        array $blacklistedItemsForGiftCard
    ): bool {
        return in_array($jellyfishOrderItemTransfer->getSku(), $blacklistedItemsForGiftCard);
    }
}
