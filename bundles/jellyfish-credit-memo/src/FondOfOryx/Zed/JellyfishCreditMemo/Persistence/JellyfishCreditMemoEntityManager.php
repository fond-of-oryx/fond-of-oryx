<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence;

use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoPersistenceFactory getFactory()
 */
class JellyfishCreditMemoEntityManager extends AbstractEntityManager implements JellyfishCreditMemoEntityManagerInterface
{
    protected const COLUMN_JELLYFISH_EXPORT_STATE = 'JellyfishExportState';

    /**
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishCreditMemoTransfer
     */
    public function updateExportState(
        JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
    ): JellyfishCreditMemoTransfer {
        $this->getFactory()
            ->createCreditMemoQuery()
            ->filterByIdCreditMemo(
                $jellyfishCreditMemoTransfer->getId()
            )->update([
                static::COLUMN_JELLYFISH_EXPORT_STATE => $jellyfishCreditMemoTransfer->getExportState(),
            ]);

        return $jellyfishCreditMemoTransfer;
    }
}
