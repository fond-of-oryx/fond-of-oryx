<?php

namespace FondOfOryx\Zed\StockProductApi\Dependency\Facade;

use Generated\Shared\Transfer\StockProductTransfer;
use Spryker\Zed\Stock\Business\StockFacadeInterface;

class StockProductApiToStockBridge implements StockProductApiToStockInterface
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
     * @param int $idProductConcrete
     *
     * @return array<\Generated\Shared\Transfer\StockProductTransfer>
     */
    public function getStockProductsByIdProduct(int $idProductConcrete): array
    {
        return $this->stockFacade->getStockProductsByIdProduct($idProductConcrete);
    }
}
