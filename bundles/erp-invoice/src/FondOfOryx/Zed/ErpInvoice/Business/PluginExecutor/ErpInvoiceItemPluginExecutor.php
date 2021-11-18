<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceItemTransfer;

class ErpInvoiceItemPluginExecutor implements ErpInvoiceItemPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface>
     */
    protected $erpInvoiceItemPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface>
     */
    protected $erpInvoiceItemPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface> $erpInvoiceItemPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface> $erpInvoiceItemPostSavePlugins
     */
    public function __construct(array $erpInvoiceItemPreSavePlugins, array $erpInvoiceItemPostSavePlugins)
    {
        $this->erpInvoiceItemPreSavePlugins = $erpInvoiceItemPreSavePlugins;
        $this->erpInvoiceItemPostSavePlugins = $erpInvoiceItemPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function executePostSavePlugins(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        foreach ($this->erpInvoiceItemPostSavePlugins as $plugin) {
            $erpInvoiceItemTransfer = $plugin->postSave($erpInvoiceItemTransfer);
        }

        return $erpInvoiceItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceItemTransfer $erpInvoiceItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceItemTransfer
     */
    public function executePreSavePlugins(ErpInvoiceItemTransfer $erpInvoiceItemTransfer): ErpInvoiceItemTransfer
    {
        foreach ($this->erpInvoiceItemPreSavePlugins as $plugin) {
            $erpInvoiceItemTransfer = $plugin->preSave($erpInvoiceItemTransfer);
        }

        return $erpInvoiceItemTransfer;
    }
}
