<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 */
class ErpOrderCalculateOutstandingQuantityErpOrderPreSavePlugin extends AbstractPlugin implements ErpOrderPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function preSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        $outstandQuantity = 0;

        foreach ($erpOrderTransfer->getOrderItems() as $item) {
            $item->setOutstandingQuantity($item->getOrderedQuantity() - $item->getShippedQuantity());

            $outstandQuantity += $item->getOutstandingQuantity();
        }

        return $erpOrderTransfer->setOutstandingQuantity($outstandQuantity);
    }
}
