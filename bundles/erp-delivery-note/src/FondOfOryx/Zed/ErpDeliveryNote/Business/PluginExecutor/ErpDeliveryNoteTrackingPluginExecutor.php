<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer;

class ErpDeliveryNoteTrackingPluginExecutor implements ErpDeliveryNoteTrackingPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface>
     */
    protected $erpDeliveryNoteTrackingPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface>
     */
    protected $erpDeliveryNoteTrackingPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface> $erpDeliveryNoteTrackingPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface> $erpDeliveryNoteTrackingPostSavePlugins
     */
    public function __construct(array $erpDeliveryNoteTrackingPreSavePlugins, array $erpDeliveryNoteTrackingPostSavePlugins)
    {
        $this->erpDeliveryNoteTrackingPreSavePlugins = $erpDeliveryNoteTrackingPreSavePlugins;
        $this->erpDeliveryNoteTrackingPostSavePlugins = $erpDeliveryNoteTrackingPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        foreach ($this->erpDeliveryNoteTrackingPostSavePlugins as $plugin) {
            $erpDeliveryNoteTrackingTransfer = $plugin->postSave($erpDeliveryNoteTrackingTransfer);
        }

        return $erpDeliveryNoteTrackingTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteTrackingTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteTrackingTransfer $erpDeliveryNoteTrackingTransfer): ErpDeliveryNoteTrackingTransfer
    {
        foreach ($this->erpDeliveryNoteTrackingPreSavePlugins as $plugin) {
            $erpDeliveryNoteTrackingTransfer = $plugin->preSave($erpDeliveryNoteTrackingTransfer);
        }

        return $erpDeliveryNoteTrackingTransfer;
    }
}
