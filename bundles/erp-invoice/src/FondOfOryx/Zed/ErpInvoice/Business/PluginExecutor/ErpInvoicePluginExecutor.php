<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoicePluginExecutor implements ErpInvoicePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface>
     */
    protected $erpInvoicePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface>
     */
    protected $erpInvoicePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface> $erpInvoicePreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface> $erpInvoicePostSavePlugins
     */
    public function __construct(array $erpInvoicePreSavePlugins, array $erpInvoicePostSavePlugins)
    {
        $this->erpInvoicePreSavePlugins = $erpInvoicePreSavePlugins;
        $this->erpInvoicePostSavePlugins = $erpInvoicePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function executePostSavePlugins(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        foreach ($this->erpInvoicePostSavePlugins as $plugin) {
            $erpInvoiceTransfer = $plugin->postSave($erpInvoiceTransfer, $existingErpInvoiceTransfer);
        }

        return $erpInvoiceTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer $erpInvoiceTransfer
     * @param \Generated\Shared\Transfer\ErpInvoiceTransfer|null $existingErpInvoiceTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceTransfer
     */
    public function executePreSavePlugins(ErpInvoiceTransfer $erpInvoiceTransfer, ?ErpInvoiceTransfer $existingErpInvoiceTransfer = null): ErpInvoiceTransfer
    {
        foreach ($this->erpInvoicePreSavePlugins as $plugin) {
            $erpInvoiceTransfer = $plugin->preSave($erpInvoiceTransfer, $existingErpInvoiceTransfer);
        }

        return $erpInvoiceTransfer;
    }
}
