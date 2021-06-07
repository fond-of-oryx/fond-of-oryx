<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage\Business\JellyfishCrossEngage;

use Generated\Shared\Transfer\JellyfishOrderItemTransfer;

interface JellyfishCrossEngageReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getGender(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string;

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderItemTransfer $jellyfishOrderItemTransfer
     *
     * @return string|null
     */
    public function getCategories(JellyfishOrderItemTransfer $jellyfishOrderItemTransfer): ?string;
}
