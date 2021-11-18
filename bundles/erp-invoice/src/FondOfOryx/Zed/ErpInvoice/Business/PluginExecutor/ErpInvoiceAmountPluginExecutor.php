<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceAmountTransfer;

class ErpInvoiceAmountPluginExecutor implements ErpInvoiceAmountPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface>
     */
    protected $erpInvoiceAmountPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface>
     */
    protected $erpInvoiceAmountPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface> $erpInvoiceAmountPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface> $erpInvoiceAmountPostSavePlugins
     */
    public function __construct(array $erpInvoiceAmountPreSavePlugins, array $erpInvoiceAmountPostSavePlugins)
    {
        $this->erpInvoiceAmountPreSavePlugins = $erpInvoiceAmountPreSavePlugins;
        $this->erpInvoiceAmountPostSavePlugins = $erpInvoiceAmountPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function executePostSavePlugins(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        foreach ($this->erpInvoiceAmountPostSavePlugins as $plugin) {
            $erpInvoiceAmountTransfer = $plugin->postSave($erpInvoiceAmountTransfer);
        }

        return $erpInvoiceAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAmountTransfer
     */
    public function executePreSavePlugins(ErpInvoiceAmountTransfer $erpInvoiceAmountTransfer): ErpInvoiceAmountTransfer
    {
        foreach ($this->erpInvoiceAmountPreSavePlugins as $plugin) {
            $erpInvoiceAmountTransfer = $plugin->preSave($erpInvoiceAmountTransfer);
        }

        return $erpInvoiceAmountTransfer;
    }
}
