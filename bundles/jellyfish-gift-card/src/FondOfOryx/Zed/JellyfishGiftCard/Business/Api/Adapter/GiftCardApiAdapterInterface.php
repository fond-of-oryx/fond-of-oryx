<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter;

use Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer;

interface GiftCardApiAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer $jellyfishGiftCardDataWrapperTransfer
     *
     * @return void
     */
    public function post(JellyfishGiftCardDataWrapperTransfer $jellyfishGiftCardDataWrapperTransfer): void;
}
