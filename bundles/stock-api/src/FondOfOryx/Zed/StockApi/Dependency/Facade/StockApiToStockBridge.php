<?php

namespace FondOfOryx\Zed\StockApi\Dependency\Facade;

use Generated\Shared\Transfer\StockProductTransfer;
use Generated\Shared\Transfer\StockTransfer;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Stock\Business\StockFacadeInterface;

class StockApiToStockBridge implements StockApiToStockInterface
{
    /**
     * @var \Spryker\Zed\Stock\Business\StockFacadeInterface
     */
    protected $stockFacade;

    /**
     * @param \Spryker\Zed\Stock\Business\StockFacadeInterface $stockFacade
     */
    public function __construct(StockFacadeInterface $stockFacade)
    {
        $this->stockFacade = $stockFacade;
    }

    /**
     * @param string $sku
     *
     * @return \Spryker\DecimalObject\Decimal
     */
    public function calculateStockForProduct(string $sku): Decimal
    {
        return $this->stockFacade->calculateStockForProduct($sku);
    }

    /**
     * @param string $sku
     *
     * @return bool
     */
    public function isNeverOutOfStock(string $sku): bool
    {
        return $this->stockFacade->isNeverOutOfStock($sku);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $transferStockProduct
     *
     * @return int
     */
    public function createStockProduct(StockProductTransfer $transferStockProduct): int
    {
        return $this->stockFacade->createStockProduct($transferStockProduct);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     *
     * @return int
     */
    public function updateStockProduct(StockProductTransfer $stockProductTransfer): int
    {
        return $this->stockFacade->updateStockProduct($stockProductTransfer);
    }

    /**
     * @return array
     */
    public function getAvailableStockTypes(): array
    {
        return $this->stockFacade->getAvailableStockTypes();
    }

    /**
     * @param int $idProductConcrete
     *
     * @return array<\Generated\Shared\Transfer\StockProductTransfer>
     */
    public function getStockProductsByIdProduct(int $idProductConcrete): array
    {
        return $this->stockFacade->getStockProductsByIdProduct($idProductConcrete);
    }

    /**
     * @param int $idStock
     *
     * @return \Generated\Shared\Transfer\StockTransfer|null
     */
    public function findStockById(int $idStock): ?StockTransfer
    {
        return $this->stockFacade->findStockById($idStock);
    }

    /**
     * @param string $stockName
     *
     * @return \Generated\Shared\Transfer\StockTransfer|null
     */
    public function findStockByName(string $stockName): ?StockTransfer
    {
        return $this->stockFacade->findStockByName($stockName);
    }
}
