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
class ErpOrderTotalPersistorErpOrderPostSavePlugin extends AbstractPlugin implements ErpOrderPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function postSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFacade()->persistErpOrderTotal($erpOrderTransfer);
    }
}
