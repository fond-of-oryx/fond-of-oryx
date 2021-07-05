<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SpyGiftCardProductConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfiguration;

class GiftCardProductConfigurationMapper implements GiftCardProductConfigurationMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration $entity
     * @param \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer
     */
    public function mapEntityToTransfer(
        SpyGiftCardProductConfiguration $entity,
        SpyGiftCardProductConfigurationEntityTransfer $transfer
    ): SpyGiftCardProductConfigurationEntityTransfer {
        return $transfer->fromArray($entity->toArray(), true);
    }
}
