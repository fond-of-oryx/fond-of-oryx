<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Expander;

use ArrayObject;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpander implements JellyfishOrderExpanderInterface
{
    protected const SALES_PAYMENT_METHOD_GIFT_CARD = 'GiftCard';

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface
     */
    protected $jellyfishOrderGiftCardMapper;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Business\Mapper\JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper
     */
    public function __construct(
        JellyfishOrderGiftCardMapperInterface $jellyfishOrderGiftCardMapper
    ) {
        $this->jellyfishOrderGiftCardMapper = $jellyfishOrderGiftCardMapper;
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
        return $jellyfishOrderTransfer->setGiftCards($this->mapSalesOrderToGiftCards($salesOrder));
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     *
     * @return \ArrayObject
     */
    protected function mapSalesOrderToGiftCards(SpySalesOrder $salesOrder): ArrayObject
    {
        $jellyfishOrderGiftCards = new ArrayObject();

        return $this->addGiftCards($salesOrder, $jellyfishOrderGiftCards);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrder
     * @param \ArrayObject $jellyfishOrderGiftCards
     *
     * @return \ArrayObject
     */
    protected function addGiftCards(
        SpySalesOrder $salesOrder,
        ArrayObject $jellyfishOrderGiftCards
    ): ArrayObject {
        foreach ($salesOrder->getOrdersJoinSalesPaymentMethodType() as $salesPayment) {
            if (
                $salesPayment->getSalesPaymentMethodType()->getPaymentMethod()
                !== static::SALES_PAYMENT_METHOD_GIFT_CARD
            ) {
                continue;
            }

            $jellyfishOrderGiftCards->append(
                $this->jellyfishOrderGiftCardMapper->fromSalesPayment($salesPayment)
            );
        }

        return $jellyfishOrderGiftCards;
    }
}
