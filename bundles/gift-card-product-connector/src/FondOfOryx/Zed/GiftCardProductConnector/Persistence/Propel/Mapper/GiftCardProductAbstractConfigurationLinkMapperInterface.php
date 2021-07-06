<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink;

interface GiftCardProductAbstractConfigurationLinkMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfigurationLink $entity
     * @param \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationLinkEntityTransfer
     */
    public function mapEntityToTransfer(
        SpyGiftCardProductAbstractConfigurationLink $entity,
        SpyGiftCardProductAbstractConfigurationLinkEntityTransfer $transfer
    ): SpyGiftCardProductAbstractConfigurationLinkEntityTransfer;
}
