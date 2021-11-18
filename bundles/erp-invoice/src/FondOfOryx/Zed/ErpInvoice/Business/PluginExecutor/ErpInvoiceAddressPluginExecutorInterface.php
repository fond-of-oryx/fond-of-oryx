<?php

namespace FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpInvoiceAddressTransfer;

interface ErpInvoiceAddressPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function executePostSavePlugins(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpInvoiceAddressTransfer
     */
    public function executePreSavePlugins(ErpInvoiceAddressTransfer $erpInvoiceAddressTransfer): ErpInvoiceAddressTransfer;
}
