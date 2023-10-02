<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfOryx\Zed\ErpOrder\Communication\Plugin\PostSave
 *
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 */
class ErpOrderItemAmountsPersisterErpOrderItemPreSavePlugin extends AbstractPlugin implements ErpOrderItemPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function preSave(ErpOrderItemTransfer $erpOrderItemTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderItemTransfer
    {
        return $this->getFacade()->persistErpOrderItemAmounts($erpOrderItemTransfer, $existingErpOrderTransfer);
    }
}
