<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface JellyfishOrderBeforeExportPluginInterface
{
    /**
     * Specification:
     *  - Plugins which can be called before order export
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function before(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void;
}
