<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PostSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class ErpOrderAddressPreSavePlugin
 *
 * @package FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave
 *
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 */
class ErpOrderExpensePersisterErpOrderPostSavePlugin extends AbstractPlugin implements ErpOrderPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     * @param \Generated\Shared\Transfer\ErpOrderTransfer|null $existingErpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function postSave(ErpOrderTransfer $erpOrderTransfer, ?ErpOrderTransfer $existingErpOrderTransfer = null): ErpOrderTransfer
    {
        return $this->getFacade()->persistErpOrderExpense($erpOrderTransfer, $existingErpOrderTransfer);
    }
}
