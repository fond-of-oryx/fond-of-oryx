<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ErpOrderFacade
 *
 * @package FondOfOryx\Zed\ErpOrder\Business
 *
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface getRepository()
 */
class ErpOrderFacade extends AbstractFacade implements ErpOrderFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function createErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        return $this->getFactory()->createErpOrderWriter()->create($erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function updateErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        return $this->getFactory()->createErpOrderWriter()->update($erpOrderTransfer);
    }

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function deleteErpOrderByIdErpOrder(int $idErpOrder): void
    {
        $this->getFactory()->createErpOrderWriter()->delete($idErpOrder);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByIdErpOrder(int $idErpOrder): ?ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderReader()->findErpOrderByIdErpOrder($idErpOrder);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistBillingAddress(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderAddressHandler()->handle($erpOrderTransfer, 'billingAddress');
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistShippingAddress(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderAddressHandler()->handle($erpOrderTransfer, 'shippingAddress');
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderItem(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderItemHandler()->handle($erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderTotal(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderTotalHandler()->handle($erpOrderTransfer);
    }
}
