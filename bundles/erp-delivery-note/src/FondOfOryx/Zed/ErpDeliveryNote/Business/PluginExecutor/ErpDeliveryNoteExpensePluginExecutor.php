<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer;

class ErpDeliveryNoteExpensePluginExecutor implements ErpDeliveryNoteExpensePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePreSavePluginInterface>
     */
    protected $erpDeliveryNoteExpensePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePostSavePluginInterface>
     */
    protected $erpDeliveryNoteExpensePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePreSavePluginInterface> $erpDeliveryNoteExpensePreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePostSavePluginInterface> $erpDeliveryNoteExpensePostSavePlugins
     */
    public function __construct(array $erpDeliveryNoteExpensePreSavePlugins, array $erpDeliveryNoteExpensePostSavePlugins)
    {
        $this->erpDeliveryNoteExpensePreSavePlugins = $erpDeliveryNoteExpensePreSavePlugins;
        $this->erpDeliveryNoteExpensePostSavePlugins = $erpDeliveryNoteExpensePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function executePostSavePlugins(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        foreach ($this->erpDeliveryNoteExpensePostSavePlugins as $plugin) {
            $erpDeliveryNoteExpenseTransfer = $plugin->postSave($erpDeliveryNoteExpenseTransfer);
        }

        return $erpDeliveryNoteExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpDeliveryNoteExpenseTransfer
     */
    public function executePreSavePlugins(ErpDeliveryNoteExpenseTransfer $erpDeliveryNoteExpenseTransfer): ErpDeliveryNoteExpenseTransfer
    {
        foreach ($this->erpDeliveryNoteExpensePreSavePlugins as $plugin) {
            $erpDeliveryNoteExpenseTransfer = $plugin->preSave($erpDeliveryNoteExpenseTransfer);
        }

        return $erpDeliveryNoteExpenseTransfer;
    }
}
