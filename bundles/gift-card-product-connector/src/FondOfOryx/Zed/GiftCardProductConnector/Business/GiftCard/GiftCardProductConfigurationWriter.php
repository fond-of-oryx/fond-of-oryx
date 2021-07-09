<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class GiftCardProductConfigurationWriter implements GiftCardProductConfigurationWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig
     */
    private $config;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface
     */
    private $entityManager;

    /**
     * @param \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig $config
     */
    public function __construct(
        GiftCardProductConnectorEntityManagerInterface $entityManager,
        GiftCardProductConnectorConfig $config
    ) {
        $this->config = $config;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer {
        return $productConcreteTransfer = $this->getTransactionHandler()->handleTransaction(function () use ($productConcreteTransfer): ProductConcreteTransfer {
                return $this->executeSaveGiftCardProductConfigurationTransaction($productConcreteTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected function executeSaveGiftCardProductConfigurationTransaction(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer {
        if (!$this->isGiftCardProduct($productConcreteTransfer)) {
            return $productConcreteTransfer;
        }

        $this->entityManager
            ->saveGiftCardProductConfiguration(
                $productConcreteTransfer,
                $this->getValue($productConcreteTransfer)
            );

        return $productConcreteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return bool
     */
    protected function isGiftCardProduct(ProductConcreteTransfer $productConcreteTransfer): bool
    {
        if (!$this->config->getGiftCardProductSkuPrefixes()) {
            return false;
        }

        return ($this->getGiftCardProductSkuPrefix($productConcreteTransfer) !== '');
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return string
     */
    protected function getGiftCardProductSkuPrefix(ProductConcreteTransfer $productConcreteTransfer): string
    {
        foreach ($this->config->getGiftCardProductSkuPrefixes() as $prefix) {
            if (strpos($productConcreteTransfer->getSku(), $prefix) === 0) {
                return $prefix;
            }
        }

        return '';
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return int
     */
    protected function getValue(ProductConcreteTransfer $productConcreteTransfer): int
    {
        /** @var \Generated\Shared\Transfer\PriceProductTransfer $productConcretePrice */
        $productConcretePrice = $productConcreteTransfer->getPrices()->offsetGet(0);

        return $productConcretePrice->getMoneyValue()->getGrossAmount();
    }
}
