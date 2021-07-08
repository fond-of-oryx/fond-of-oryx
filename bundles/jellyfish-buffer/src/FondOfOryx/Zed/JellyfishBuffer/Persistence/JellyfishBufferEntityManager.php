<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Persistence;

use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferPersistenceFactory getFactory()
 */
class JellyfishBufferEntityManager extends AbstractEntityManager implements JellyfishBufferEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function createExportedOrder(JellyfishOrderTransfer $jellyfishOrderTransfer, array $options): void
    {
        $jellyfishOrderTransfer->requireId()
            ->requireReference();

        $fooExportedOrder = $this->getFactory()
            ->createJellyfishBufferMapper()
            ->mapTransferAndOptionsToEntity(
                $jellyfishOrderTransfer,
                $options,
                $this->getFactory()->createExportedOrderQuery()->filterByFkSalesOrder($jellyfishOrderTransfer->getId())->findOneOrCreate()
            );

        $fooExportedOrder->save();
    }
}
