<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Communication\Plugin\PreSave;

use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface getFacade()
 */
class ErpDeliveryNoteBillingAddressPersisterErpDeliveryNotePreSavePlugin extends AbstractPlugin implements ErpDeliveryNotePreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function preSave(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFacade()->persistBillingAddress($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
    }
}
