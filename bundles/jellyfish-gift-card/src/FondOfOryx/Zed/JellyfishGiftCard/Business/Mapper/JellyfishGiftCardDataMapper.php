<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardDataTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;

class JellyfishGiftCardDataMapper implements JellyfishGiftCardDataMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapperInterface
     */
    protected $jellyfishGiftCardMapper;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapperInterface $jellyfishGiftCardMapper
     */
    public function __construct(JellyfishGiftCardMapperInterface $jellyfishGiftCardMapper)
    {
        $this->jellyfishGiftCardMapper = $jellyfishGiftCardMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardDataTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishGiftCardDataTransfer {
        $jellyfishGiftCardTransfer = $this->jellyfishGiftCardMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer
        );

        if ($jellyfishGiftCardTransfer === null) {
            return null;
        }

        return (new JellyfishGiftCardDataTransfer())
            ->setAttributes($jellyfishGiftCardTransfer);
    }
}
