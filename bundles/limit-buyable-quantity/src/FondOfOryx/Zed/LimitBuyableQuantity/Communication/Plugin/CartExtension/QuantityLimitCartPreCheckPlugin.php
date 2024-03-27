<?php

namespace FondOfOryx\Zed\LimitBuyableQuantity\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\CartChangeTransfer;
use Generated\Shared\Transfer\CartPreCheckResponseTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\CartPreCheckPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\LimitBuyableQuantity\LimitBuyableQuantityConfig getConfig()
 */
class QuantityLimitCartPreCheckPlugin extends AbstractPlugin implements CartPreCheckPluginInterface
{
    /**
     * @var string
     */
    public const MESSAGE_ERROR_QUANTITY_LIMIT_EXCEEDED = 'limit-buyable-quantity.validation.error.quantity-limit-exceeded';

    /**
     * @var string
     */
    public const MESSAGE_PARAM_SKU = 'sku';

    /**
     * @var string
     */
    public const MESSAGE_PARAM_NAME = 'name';

    /**
     * @var string
     */
    public const MESSAGE_PARAM_MAX_QUANTITY = 'maxQuantity';

    /**
     * @param \Generated\Shared\Transfer\CartChangeTransfer $cartChangeTransfer
     *
     * @return \Generated\Shared\Transfer\CartPreCheckResponseTransfer
     */
    public function check(CartChangeTransfer $cartChangeTransfer): CartPreCheckResponseTransfer
    {
        $maxQuantity = $this->getConfig()->getMaxQuantity();
        $cartPreCheckResponseTransfer = (new CartPreCheckResponseTransfer())
            ->setIsSuccess(true);

        if ($maxQuantity === null) {
            return $cartPreCheckResponseTransfer;
        }

        foreach ($cartChangeTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getQuantity() <= $maxQuantity) {
                continue;
            }

            $messageTransfer = (new MessageTransfer())->setValue(static::MESSAGE_ERROR_QUANTITY_LIMIT_EXCEEDED)
                ->setParameters(
                    [
                        static::MESSAGE_PARAM_SKU => $itemTransfer->getSku(),
                        static::MESSAGE_PARAM_NAME => $itemTransfer->getName(),
                        static::MESSAGE_PARAM_MAX_QUANTITY => $maxQuantity,
                    ],
                );

            return $cartPreCheckResponseTransfer->setIsSuccess(false)
                ->addMessage($messageTransfer);
        }

        return $cartPreCheckResponseTransfer;
    }
}
