<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer;

class ErpDeliveryNoteItemPluginExecutor implements ErpDeliveryNoteItemPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface>
     */
    protected $erpDeliveryNoteItemPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface>
     */
    protected $erpDeliveryNoteItemPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface> $erpDeliveryNoteItemPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface> $erpDeliveryNoteItemPostSavePlugins
     */
    public function __construct(array $erpDeliveryNoteItemPreSavePlugins, array $erpDeliveryNoteItemPostSavePlugins)
    {
        $this->erpDeliveryNoteItemPreSavePlugins = $erpDeliveryNoteItemPreSavePlugins;
        $this->erpDeliveryNoteItemPostSavePlugins = $erpDeliveryNoteItemPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        foreach ($this->erpDeliveryNoteItemPostSavePlugins as $plugin) {
            $erpDeliveryNoteItemTransfer = $plugin->postSave($erpDeliveryNoteItemTransfer);
        }

        return $erpDeliveryNoteItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteItemTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteItemTransfer $erpDeliveryNoteItemTransfer): ErpDeliveryNoteItemTransfer
    {
        foreach ($this->erpDeliveryNoteItemPreSavePlugins as $plugin) {
            $erpDeliveryNoteItemTransfer = $plugin->preSave($erpDeliveryNoteItemTransfer);
        }

        return $erpDeliveryNoteItemTransfer;
    }
}
