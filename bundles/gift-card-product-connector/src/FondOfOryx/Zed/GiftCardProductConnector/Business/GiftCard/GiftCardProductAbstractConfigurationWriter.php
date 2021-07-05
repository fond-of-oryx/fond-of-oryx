<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationQuery;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class GiftCardProductAbstractConfigurationWriter implements GiftCardProductAbstractConfigurationWriterInterface
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
     * GiftCardProductConfigurationWriter constructor.
     *
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
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function saveGiftCardProductAbstractConfiguration(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {
        return $this->getTransactionHandler()->handleTransaction(function ()
            use ($productAbstractTransfer): ProductAbstractTransfer {
                return $this->executeSaveGiftCardProductAbstractConfigurationTransaction($productAbstractTransfer);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected function executeSaveGiftCardProductAbstractConfigurationTransaction(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {

        if (!$this->isGiftCardProduct($productAbstractTransfer)) {
            return $productAbstractTransfer;
        }

        $this->entityManager
            ->createGiftCardProductAbstractConfiguration(
                $productAbstractTransfer,
                $this->getPattern($productAbstractTransfer)
            );

        return $productAbstractTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return bool
     */
    protected function isGiftCardProduct(ProductAbstractTransfer $productAbstractTransfer): bool
    {
        if (!$this->config->getGiftCardProductSkuPrefixes()) {
            return false;
        }

        return ($this->getGiftCardProductSkuPrefix($productAbstractTransfer) !== '');
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return string
     */
    protected function getPattern(ProductAbstractTransfer $productAbstractTransfer): string
    {
        $skuPrefix = $this->getGiftCardProductSkuPrefix($productAbstractTransfer);

        if (!$skuPrefix) {
            return '';
        }

        return $skuPrefix . '{randomPart}' . '-' . $this->getGiftCardPatternSuffix($productAbstractTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return string
     */
    protected function getGiftCardProductSkuPrefix(ProductAbstractTransfer $productAbstractTransfer): string
    {
        foreach ($this->config->getGiftCardProductSkuPrefixes() as $prefix) {
            if (strpos($productAbstractTransfer->getSku(), 'Abstract-' . $prefix) === 0 ) {
                return $prefix;
            }
        }

        return '';
    }

    /**
     * @TODO Get Suffix Based on an Attribute because There are different MoneyValues based on different criteria
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return string
     */
    protected function getGiftCardPatternSuffix(ProductAbstractTransfer $productAbstractTransfer): string
    {
        /** @var \Generated\Shared\Transfer\PriceProductTransfer $productAbstractPrice */
        $productAbstractPrice = $productAbstractTransfer->getPrices()->offsetGet(0);

        return $productAbstractPrice->getMoneyValue()->getGrossAmount();
    }
}
