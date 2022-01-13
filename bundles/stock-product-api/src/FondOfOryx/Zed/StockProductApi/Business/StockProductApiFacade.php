<?php

namespace FondOfOryx\Zed\StockProductApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\StockProductApi\Business\StockProductApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface getRepository()
 */
class StockProductApiFacade extends AbstractFacade implements StockProductApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idStockProduct
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateStockProduct(int $idStockProduct, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createStockProductApi()
            ->update($idStockProduct, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createStockProduct(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createStockProductApi()
            ->create($apiDataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findStockProduct(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createStockProductApi()->find($apiRequestTransfer);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getStockProductById($id): ApiItemTransfer
    {
        return $this->getFactory()->createStockProductApi()->getStockProductById($id);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()
            ->createStockProductApiValidator()
            ->validate($apiDataTransfer);
    }
}
