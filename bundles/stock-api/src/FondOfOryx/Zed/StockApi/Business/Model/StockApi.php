<?php

namespace FondOfOryx\Zed\StockApi\Business\Model;

use FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class StockApi implements StockApiInterface
{
    /**
     * @var \FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface
     */
    protected $stockReader;

    /**
     * @param \FondOfOryx\Zed\StockApi\Business\Model\Reader\StockReaderInterface $stockReader
     */
    public function __construct(StockReaderInterface $stockReader)
    {
        $this->stockReader = $stockReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->stockReader->findStock($apiRequestTransfer);
    }

    /**
     * @param int $idStock
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $idStock): ApiItemTransfer
    {
        return $this->stockReader->getStockById($idStock);
    }
}
