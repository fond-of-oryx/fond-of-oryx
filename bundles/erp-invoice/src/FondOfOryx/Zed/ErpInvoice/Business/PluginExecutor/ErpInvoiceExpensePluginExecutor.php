<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceExpenseTransfer;

class ErpInvoiceExpensePluginExecutor implements ErpInvoiceExpensePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface>
     */
    protected $erpInvoiceExpensePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface>
     */
    protected $erpInvoiceExpensePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePreSavePluginInterface> $erpInvoiceExpensePreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceExpensePostSavePluginInterface> $erpInvoiceExpensePostSavePlugins
     */
    public function __construct(array $erpInvoiceExpensePreSavePlugins, array $erpInvoiceExpensePostSavePlugins)
    {
        $this->erpInvoiceExpensePreSavePlugins = $erpInvoiceExpensePreSavePlugins;
        $this->erpInvoiceExpensePostSavePlugins = $erpInvoiceExpensePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function executePostSavePlugins(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        foreach ($this->erpInvoiceExpensePostSavePlugins as $plugin) {
            $erpInvoiceExpenseTransfer = $plugin->postSave($erpInvoiceExpenseTransfer);
        }

        return $erpInvoiceExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceExpenseTransfer
     */
    public function executePreSavePlugins(ErpInvoiceExpenseTransfer $erpInvoiceExpenseTransfer): ErpInvoiceExpenseTransfer
    {
        foreach ($this->erpInvoiceExpensePreSavePlugins as $plugin) {
            $erpInvoiceExpenseTransfer = $plugin->preSave($erpInvoiceExpenseTransfer);
        }

        return $erpInvoiceExpenseTransfer;
    }
}
