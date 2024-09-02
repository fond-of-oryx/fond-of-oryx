<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ErpOrderResolveExpectedDeliveryDateErpOrderPreSavePlugin extends AbstractPlugin implements ErpOrderPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function preSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        $earliestDate = null;

        foreach ($erpOrderTransfer->getOrderItems() as $item) {
            if ($earliestDate === null || strtotime($item->getExpectedDeliveryDate()) < strtotime($earliestDate)) {
                $earliestDate = $item->getExpectedDeliveryDate();
            }
        }

        return $erpOrderTransfer->setExpectedDeliveryDate($earliestDate);
    }
}
