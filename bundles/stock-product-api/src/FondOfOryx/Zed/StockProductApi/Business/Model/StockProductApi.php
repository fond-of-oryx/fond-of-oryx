<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Model;

use Exception;
use FondOfOryx\Zed\StockProductApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReaderInterface;
use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface;
use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\StockProductTransfer;

class StockProductApi implements StockProductApiInterface
{
    /**
     * @var \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface
     */
    protected $stockFacade;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReaderInterface
     */
    protected $stockReader;

    /**
     * @param \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\StockProductApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface $stockFacade
     * @param \FondOfOryx\Zed\StockProductApi\Business\Model\Reader\StockReaderInterface $stockReader
     */
    public function __construct(
        StockProductApiToApiFacadeInterface $apiFacade,
        TransferMapperInterface $transferMapper,
        StockProductApiToStockInterface $stockFacade,
        StockReaderInterface $stockReader
    ) {
        $this->apiFacade = $apiFacade;
        $this->transferMapper = $transferMapper;
        $this->stockFacade = $stockFacade;
        $this->stockReader = $stockReader;
    }

    /**
     * @param int $idStockProduct
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function update(int $idStockProduct, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $stockProductTransfer = $this->transferMapper->toTransfer($apiDataTransfer->getData());
        $stockProductTransfer->setIdStockProduct($idStockProduct);

        if ($this->preValidate($stockProductTransfer) === false) {
            throw new Exception(sprintf('Provided idStockProduct "%d" does not match given SKU "%s" and stock type "%s"', $idStockProduct, $stockProductTransfer->getSku(), $stockProductTransfer->getStockType()));
        }

        $idProduct = $this->stockFacade->updateStockProduct($stockProductTransfer);

        return $this->apiFacade->createApiItem($stockProductTransfer, (string)$idProduct);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function create(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $stockProductTransfer = $this->transferMapper->toTransfer($apiDataTransfer->getData());
        $idProduct = $this->stockFacade->createStockProduct($stockProductTransfer);

        return $this->apiFacade->createApiItem($stockProductTransfer, (string)$idProduct);
    }

    /**
     * @param int $idStockProduct
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getStockProductById(int $idStockProduct): ApiItemTransfer
    {
        return $this->stockReader->getStockProductById($idStockProduct);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->stockReader->findStockProduct($apiRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\StockProductTransfer $stockProductTransfer
     *
     * @return bool
     */
    protected function preValidate(StockProductTransfer $stockProductTransfer): bool
    {
        $data = $this->getStockProductById($stockProductTransfer->getIdStockProduct());
        $transfer = $this->transferMapper->toTransfer($data->getData());

        return $transfer->getSku() === $stockProductTransfer->getSku() && $transfer->getStockType() === $stockProductTransfer->getStockType();
    }
}
