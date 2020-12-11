<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class ErpOrderAddressPreSavePlugin
 *
 * @package FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave
 *
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 */
class ErpOrderShippingAddressPersistorErpOrderPreSavePlugin extends AbstractPlugin implements ErpOrderPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function preSave(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        return $this->getFacade()->persistShippingAddress($erpOrderTransfer);
    }
}
