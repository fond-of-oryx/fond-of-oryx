<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;
use function DeepCopy\deep_copy;

class ErpDeliveryNotePluginExecutor implements ErpDeliveryNotePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface>
     */
    protected $erpDeliveryNotePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface>
     */
    protected $erpDeliveryNotePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface> $erpDeliveryNotePreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface> $erpDeliveryNotePostSavePlugins
     */
    public function __construct(array $erpDeliveryNotePreSavePlugins, array $erpDeliveryNotePostSavePlugins)
    {
        $this->erpDeliveryNotePreSavePlugins = $erpDeliveryNotePreSavePlugins;
        $this->erpDeliveryNotePostSavePlugins = $erpDeliveryNotePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function executePostSavePlugins(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        foreach ($this->erpDeliveryNotePostSavePlugins as $plugin) {
            $erpDeliveryNoteTransfer = $plugin->postSave($erpDeliveryNoteTransfer, deep_copy($existingErpDeliveryNoteTransfer));
        }

        return $erpDeliveryNoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|null $existingErpDeliveryNoteTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTransfer
     */
    public function executePreSavePlugins(
        ErpDeliveryNoteTransfer $erpDeliveryNoteTransfer,
        ?ErpDeliveryNoteTransfer $existingErpDeliveryNoteTransfer = null
    ): ErpDeliveryNoteTransfer {
        foreach ($this->erpDeliveryNotePreSavePlugins as $plugin) {
            $erpDeliveryNoteTransfer = $plugin->preSave($erpDeliveryNoteTransfer, deep_copy($existingErpDeliveryNoteTransfer));
        }

        return $erpDeliveryNoteTransfer;
    }
}
