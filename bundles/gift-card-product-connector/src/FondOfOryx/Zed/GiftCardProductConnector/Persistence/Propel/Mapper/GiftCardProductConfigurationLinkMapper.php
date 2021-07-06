<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLink;

class GiftCardProductConfigurationLinkMapper implements GiftCardProductConfigurationLinkMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductConfigurationLink $entity
     * @param \Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductConfigurationLinkEntityTransfer
     */
    public function mapEntityToTransfer(
        SpyGiftCardProductConfigurationLink $entity,
        SpyGiftCardProductConfigurationLinkEntityTransfer $transfer
    ): SpyGiftCardProductConfigurationLinkEntityTransfer {
        return $transfer->fromArray($entity->toArray(), true);
    }
}
