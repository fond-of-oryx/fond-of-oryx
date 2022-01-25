<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Communication\Plugin;

use FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishBuffer\JellyfishBufferConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Communication\JellyfishBufferCommunicationFactory getFactory()
 */
class JellyfishBufferBeforeOrderExportPlugin extends AbstractPlugin implements JellyfishOrderBeforeExportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function before(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
        $this->getFacade()->bufferOrder($jellyfishOrderTransfer, $options);
    }
}
