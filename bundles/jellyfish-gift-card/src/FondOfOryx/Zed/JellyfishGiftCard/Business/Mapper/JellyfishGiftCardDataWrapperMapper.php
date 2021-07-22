<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;

class JellyfishGiftCardDataWrapperMapper implements JellyfishGiftCardDataWrapperMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapperInterface
     */
    protected $jellyfishGiftCardDataMapper;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapperInterface $jellyfishGiftCardDataMapper
     */
    public function __construct(JellyfishGiftCardDataMapperInterface $jellyfishGiftCardDataMapper)
    {
        $this->jellyfishGiftCardDataMapper = $jellyfishGiftCardDataMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardDataWrapperTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishGiftCardDataWrapperTransfer {
        $jellyfishGiftCardDataTransfer = $this->jellyfishGiftCardDataMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer
        );

        if ($jellyfishGiftCardDataTransfer === null) {
            return null;
        }

        return (new JellyfishGiftCardDataWrapperTransfer())
            ->setData($jellyfishGiftCardDataTransfer);
    }
}
