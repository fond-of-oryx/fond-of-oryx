<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Dependency\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishBufferBeforeOrderExportPlugin implements JellyfishOrderBeforeExportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function before(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
    }
}
