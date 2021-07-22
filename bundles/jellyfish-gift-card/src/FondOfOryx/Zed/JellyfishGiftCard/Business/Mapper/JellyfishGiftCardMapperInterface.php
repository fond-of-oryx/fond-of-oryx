<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardTransfer;

interface JellyfishGiftCardMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishGiftCardTransfer;
}
