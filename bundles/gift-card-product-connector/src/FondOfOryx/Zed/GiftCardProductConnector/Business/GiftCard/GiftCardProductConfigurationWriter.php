<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Business\GiftCard;

use FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface;
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
     * @var \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface
     */
    private $productFacade;

    /**
     * @param \FondOfOryx\Zed\GiftCardProductConnector\Dependency\Facade\GiftCardProductConnectorToProductFacadeInterface $productFacade
     * @param \FondOfOryx\Zed\GiftCardProductConnector\Persistence\GiftCardProductConnectorEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\GiftCardProductConnector\GiftCardProductConnectorConfig $config
     */
    public function __construct(
        GiftCardProductConnectorToProductFacadeInterface $productFacade,
        GiftCardProductConnectorEntityManagerInterface $entityManager,
        GiftCardProductConnectorConfig $config
    ) {
        $this->config = $config;
        $this->entityManager = $entityManager;
        $this->productFacade = $productFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcreteTransfer
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    public function saveGiftCardProductConfiguration(
        ProductConcreteTransfer $productConcreteTransfer
    ): ProductConcreteTransfer {
        return $productConcreteTransfer = $this->getTransactionHandler()->handleTransaction(function ()
 use ($productConcreteTransfer): ProductConcreteTransfer {
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
            ->createGiftCardProductConfiguration(
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
        $productAbstractTransfer = $this->productFacade->findProductAbstractById($productConcreteTransfer->getFkProductAbstract());

        /** @var \Generated\Shared\Transfer\PriceProductTransfer $productAbstractPrice */
        $productAbstractPrice = $productAbstractTransfer->getPrices()->offsetGet(0);

        return $productAbstractPrice->getMoneyValue()->getGrossAmount();
    }
}
