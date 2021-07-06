<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration;

interface GiftCardProductConfigurationMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration $entity
     * @param \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer
     */
    public function mapEntityToTransfer(
        SpyGiftCardProductConfiguration $entity,
        SpyGiftCardProductConfigurationEntityTransfer $transfer
    ): SpyGiftCardProductConfigurationEntityTransfer;
}
