<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

class ErpInvoiceAddressPluginExecutor implements ErpInvoiceAddressPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface>
     */
    protected $erpInvoiceAddressPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface>
     */
    protected $erpInvoiceAddressPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface> $erpInvoiceAddressPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface> $erpInvoiceAddressPostSavePlugins
     */
    public function __construct(array $erpInvoiceAddressPreSavePlugins, array $erpInvoiceAddressPostSavePlugins)
    {
        $this->erpInvoiceAddressPreSavePlugins = $erpInvoiceAddressPreSavePlugins;
        $this->erpInvoiceAddressPostSavePlugins = $erpInvoiceAddressPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function executePostSavePlugins(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        foreach ($this->erpInvoiceAddressPostSavePlugins as $plugin) {
            $erpInvoiceAddressTransfer = $plugin->postSave($erpInvoiceAddressTransfer);
        }

        return $erpInvoiceAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function executePreSavePlugins(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer
    {
        foreach ($this->erpInvoiceAddressPreSavePlugins as $plugin) {
            $erpInvoiceAddressTransfer = $plugin->preSave($erpInvoiceAddressTransfer);
        }

        return $erpInvoiceAddressTransfer;
    }
}
