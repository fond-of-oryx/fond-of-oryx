<?php

namespace FondOfOryx\Zed\Invoice\Business\Model;

use Generated\Shared\Transfer\InvoiceTransfer;

class InvoicePluginExecutor implements InvoicePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePreSavePluginInterface>
     */
    protected $invoicePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface>
     */
    protected $invoicePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePreSavePluginInterface> $invoicePreSavePlugins
     * @param array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface> $invoicePostSavePlugins
     */
    public function __construct(
        array $invoicePreSavePlugins,
        array $invoicePostSavePlugins
    ) {
        $this->invoicePreSavePlugins = $invoicePreSavePlugins;
        $this->invoicePostSavePlugins = $invoicePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function executePostSavePlugins(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer {
        foreach ($this->invoicePostSavePlugins as $invoicePostSavePlugin) {
            $invoiceTransfer = $invoicePostSavePlugin
                ->postSave($invoiceTransfer);
        }

        return $invoiceTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\InvoiceTransfer $invoiceTransfer
     *
     * @return \Generated\Shared\Transfer\InvoiceTransfer
     */
    public function executePreSavePlugins(
        InvoiceTransfer $invoiceTransfer
    ): InvoiceTransfer {
        foreach ($this->invoicePreSavePlugins as $invoicePreSavePlugin) {
            $invoiceTransfer = $invoicePreSavePlugin
                ->preSave($invoiceTransfer);
        }

        return $invoiceTransfer;
    }
}
