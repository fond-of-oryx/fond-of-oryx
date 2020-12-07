<?php

namespace FondOfOryx\Zed\ErpOrderApi\Dependency\Facade;

use FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderApiToErpOrderFacadeBridge implements ErpOrderApiToErpOrderFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface
     */
    protected $erpOrderFacade;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface $erpOrderFacade
     */
    public function __construct(ErpOrderFacadeInterface $erpOrderFacade)
    {
        $this->erpOrderFacade = $erpOrderFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function createErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        return $this->erpOrderFacade->createErpOrder($erpOrderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderResponseTransfer
     */
    public function updateErpOrder(ErpOrderTransfer $erpOrderTransfer): ErpOrderResponseTransfer
    {
        return $this->erpOrderFacade->updateErpOrder($erpOrderTransfer);
    }

    /**
     * @param int $idErpOrder
     *
     * @return void
     */
    public function deleteErpOrderByIdErpOrder(int $idErpOrder): void
    {
        $this->erpOrderFacade->deleteErpOrderByIdErpOrder($idErpOrder);
    }

    /**
     * @param int $idErpOrder
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer|null
     */
    public function findErpOrderByIdErpOrder(int $idErpOrder): ?ErpOrderTransfer
    {
        return $this->erpOrderFacade->findErpOrderByIdErpOrder($idErpOrder);
    }
}
