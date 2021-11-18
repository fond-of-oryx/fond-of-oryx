<?php

namespace FondOfOryx\Zed\ErpInvoice\Business;

use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandler;
use Generated\Shared\Transfer\ErpInvoiceItemTransfer;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ErpInvoiceFacade
 *
 * @package FondOfOryx\Zed\ErpInvoice\Business
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Business\ErpInvoiceBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface getRepository()
 */
class ErpInvoiceFacade extends AbstractFacade implements ErpInvoiceFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function createErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        return $this->getFactory()->createErpInvoiceWriter()->create($erpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceResponseTransfer
     */
    public function updateErpInvoice(ErpInvoiceTransfer $erpInvoiceTransfer): ErpInvoiceResponseTransfer
    {
        return $this->getFactory()->createErpInvoiceWriter()->update($erpInvoiceTransfer);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return void
     */
    public function deleteErpInvoiceByIdErpInvoice(int $idErpInvoice): void
    {
        $this->getFactory()->createErpInvoiceWriter()->delete($idErpInvoice);
    }

    /**
     * @param int $idErpInvoice
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer|null
     */
    public function findErpInvoiceByIdErpInvoice(int $idErpInvoice): ?ErpInvoiceTransfer
    {
        return $this->getFactory()->createErpInvoiceReader()->findErpInvoiceByIdErpInvoice($idErpInvoice);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function persistBillingAddress(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFactory()->createErpInvoiceAddressHandler()->handle($erpInvoiceTransfer, ErpInvoiceAddressHandler::BILLING_TYPE, $existingErpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function persistShippingAddress(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFactory()->createErpInvoiceAddressHandler()->handle($erpInvoiceTransfer, ErpInvoiceAddressHandler::SHIPPING_TYPE, $existingErpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function persistErpInvoiceItem(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFactory()->createErpInvoiceItemHandler()->handle($erpInvoiceTransfer, $existingErpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function persistErpInvoiceAmount(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        return $this->getFactory()->createErpInvoiceAmountHandler()->handle($erpInvoiceTransfer, $existingErpInvoiceTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function persistErpInvoiceItemAmounts(
        ErpInvoiceItemTransfer $erpInvoiceItemTransfer,
        ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null
    ): ErpInvoiceItemTransfer {
        return $this->getFactory()->createErpInvoiceItemAmountHandler()->handle($erpInvoiceItemTransfer, $existingErpInvoiceTransfer);
    }
}
