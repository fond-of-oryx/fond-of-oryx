<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailRecipientTransfer;

class JellyfishMailRecipientMapper implements JellyfishMailRecipientMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishMailRecipientTransfer|null
     */
    public function fromJellyfishGiftCardRequest(JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer): ?JellyfishMailRecipientTransfer
    {
        $orderTransfer = $jellyfishGiftCardRequestTransfer->getOrder();

        if ($orderTransfer === null) {
            return null;
        }

        return (new JellyfishMailRecipientTransfer())->setFirstname($orderTransfer->getFirstName())
            ->setLastname($orderTransfer->getLastName())
            ->setEmail($orderTransfer->getEmail());
    }
}
