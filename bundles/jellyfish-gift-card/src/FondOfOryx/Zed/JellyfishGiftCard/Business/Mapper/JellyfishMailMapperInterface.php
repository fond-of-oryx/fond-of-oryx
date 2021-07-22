<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailTransfer;

interface JellyfishMailMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishMailTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishMailTransfer;
}
