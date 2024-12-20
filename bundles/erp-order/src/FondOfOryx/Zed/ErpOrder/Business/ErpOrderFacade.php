<?php

namespace FondOfOryx\Zed\ErpOrder\Business;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
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
     * @param string $reference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByReference(string $reference): ?ErpOrderTransfer
    {
        return $this->getRepository()->findErpOrderByReference($reference);
    }

    /**
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByExternalReference(string $externalReference): ?ErpOrderTransfer
    {
        return $this->getRepository()->findErpOrderByExternalReference($externalReference);
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
    public function persistErpOrderTotals(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderTotalsHandler()->handle($erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function persistErpOrderExpense(ErpOrderTransfer $erpOrderTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderTransfer
    {
        return $this->getFactory()->createErpOrderExpenseHandler()->handle($erpOrderTransfer, $existingErpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function persistErpOrderItemAmounts(
        ErpOrderItemTransfer $erpOrderItemTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderItemTransfer {
        return $this->getFactory()->createErpOrderItemAmountHandler()->handle($erpOrderItemTransfer, $existingErpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function persistErpOrderExpenseAmounts(
        ErpOrderExpenseTransfer $erpOrderExpenseTransfer,
        ?ErpOrderTransfer $existingErpOrderTransfer = null
    ): ErpOrderExpenseTransfer {
        return $this->getFactory()->createErpOrderExpenseAmountHandler()->handle($erpOrderExpenseTransfer, $existingErpOrderTransfer);
    }
}
