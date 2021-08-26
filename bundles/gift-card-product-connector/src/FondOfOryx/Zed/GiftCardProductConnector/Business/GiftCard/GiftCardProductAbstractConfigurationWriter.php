<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface;
use FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig;
use FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class GiftCardProductAbstractConfigurationWriter implements GiftCardProductAbstractConfigurationWriterInterface
{
    use TransactionTrait;

    protected const PATTERN = '{randomPart}';
    protected const PRODUCT_ABSTRACT_SKU_PREFIX = 'Abstract-';

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface
     */
    protected $giftCardAmountFilter;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig
     */
    private $config;

    /**
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface
     */
    private $entityManager;

    /**
     * @param \FondOfOryx\Zed\GiftCardProductConnector\Business\Filter\GiftCardAmountFilterInterface $giftCardAmountFilter
     * @param \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig $config
     */
    public function __construct(
        GiftCardAmountFilterInterface $giftCardAmountFilter,
        GiftCardProductConnectorEntityManagerInterface $entityManager,
        GiftCardProductConnectorConfig $config
    ) {
        $this->giftCardAmountFilter = $giftCardAmountFilter;
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
        $self = $this;

        return $this->getTransactionHandler()->handleTransaction(
            function () use ($self, $productAbstractTransfer): ProductAbstractTransfer {
                return $self->executeSaveGiftCardProductAbstractConfigurationTransaction($productAbstractTransfer);
            }
        );
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

        $this->entityManager->saveGiftCardProductAbstractConfiguration(
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

        $giftCardAmount = $this->giftCardAmountFilter->filterFromPriceProducts($productAbstractTransfer->getPrices());

        return sprintf('%s%s-%s', $skuPrefix, static::PATTERN, $giftCardAmount);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return string
     */
    protected function getGiftCardProductSkuPrefix(ProductAbstractTransfer $productAbstractTransfer): string
    {
        foreach ($this->config->getGiftCardProductSkuPrefixes() as $prefix) {
            if (strpos($productAbstractTransfer->getSku(), static::PRODUCT_ABSTRACT_SKU_PREFIX . $prefix) === 0) {
                return $prefix;
            }
        }

        return '';
    }
}
