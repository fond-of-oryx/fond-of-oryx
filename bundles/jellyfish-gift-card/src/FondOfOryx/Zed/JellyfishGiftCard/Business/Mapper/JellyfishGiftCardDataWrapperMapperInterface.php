<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;

interface JellyfishGiftCardDataWrapperMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishGiftCardDataWrapperTransfer;
}
