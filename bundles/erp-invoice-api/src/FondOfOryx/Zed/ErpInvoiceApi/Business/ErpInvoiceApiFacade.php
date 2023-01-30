<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiBusinessFactory getFactory()
 */
class ErpInvoiceApiFacade extends AbstractFacade implements ErpInvoiceApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function createErpInvoice(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpInvoiceApi()
            ->create($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpInvoice
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateErpInvoice(int $idErpInvoice, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpInvoiceApi()
            ->update($idErpInvoice, $apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getErpInvoice(int $idErpInvoice): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpInvoiceApi()
            ->get($idErpInvoice);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findErpInvoices(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()
            ->createErpInvoiceApi()
            ->find($apiRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function deleteErpInvoice(int $idErpInvoice): ApiItemTransfer
    {
        return $this->getFactory()
            ->createErpInvoiceApi()
            ->delete($idErpInvoice);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validateErpInvoice(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFactory()
            ->createErpInvoiceApiValidator()
            ->validate($apiRequestTransfer);
    }
}
