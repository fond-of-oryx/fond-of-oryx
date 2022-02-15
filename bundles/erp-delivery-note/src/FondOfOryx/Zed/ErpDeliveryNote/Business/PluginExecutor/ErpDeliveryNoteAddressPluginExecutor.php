<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer;

class ErpDeliveryNoteAddressPluginExecutor implements ErpDeliveryNoteAddressPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface>
     */
    protected $erpDeliveryNoteAddressPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface>
     */
    protected $erpDeliveryNoteAddressPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface> $erpDeliveryNoteAddressPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface> $erpDeliveryNoteAddressPostSavePlugins
     */
    public function __construct(array $erpDeliveryNoteAddressPreSavePlugins, array $erpDeliveryNoteAddressPostSavePlugins)
    {
        $this->erpDeliveryNoteAddressPreSavePlugins = $erpDeliveryNoteAddressPreSavePlugins;
        $this->erpDeliveryNoteAddressPostSavePlugins = $erpDeliveryNoteAddressPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        foreach ($this->erpDeliveryNoteAddressPostSavePlugins as $plugin) {
            $erpDeliveryNoteAddressTransfer = $plugin->postSave($erpDeliveryNoteAddressTransfer);
        }

        return $erpDeliveryNoteAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteAddressTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteAddressTransfer $erpDeliveryNoteAddressTransfer): ErpDeliveryNoteAddressTransfer
    {
        foreach ($this->erpDeliveryNoteAddressPreSavePlugins as $plugin) {
            $erpDeliveryNoteAddressTransfer = $plugin->preSave($erpDeliveryNoteAddressTransfer);
        }

        return $erpDeliveryNoteAddressTransfer;
    }
}
