<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Communication\Plugin\PostSave;

use FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Class ErpDeliveryNoteAddressPreSavePlugin
 *
 * @package FondOfOryx\Zed\ErpDeliveryNote\Communication\Plugin\PreSave
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Business\ErpDeliveryNoteFacadeInterface getFacade()
 */
class ErpDeliveryNoteExpensePersisterErpDeliveryNotePostSavePlugin extends AbstractPlugin implements ErpDeliveryNotePostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function postSave(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        return $this->getFacade()->persistErpDeliveryNoteExpense($erpDeliveryNoteTransfer, $existingErpDeliveryNoteTransfer);
    }
}
