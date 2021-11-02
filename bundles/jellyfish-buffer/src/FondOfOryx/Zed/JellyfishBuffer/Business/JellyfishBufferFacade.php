<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business;

use Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferRepositoryInterface getRepository()
 */
class JellyfishBufferFacade extends AbstractFacade implements JellyfishBufferFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function bufferOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options
    ): void {
        $this->getFactory()
            ->createJellyfishBufferOrder()
            ->buffer(
                $jellyfishOrderTransfer,
                $options,
            );
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer
     *
     * @return bool
     */
    public function exportFromBufferTable(JellyfishBufferTableFilterTransfer $jellyfishBufferTableFilterTransfer): bool
    {
        return $this->getFactory()->createOrderExport()->export($jellyfishBufferTableFilterTransfer);
    }
}
