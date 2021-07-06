<?php

namespace FondOfOryx\Zed\GiftCardProductConnector\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer;
use Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration;

interface GiftCardProductAbstractConfigurationMapperInterface
{
    /**
     * @param \Orm\Zed\GiftCard\Persistence\SpyGiftCardProductAbstractConfiguration $entity
     * @param \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer $transfer
     *
     * @return \Generated\Shared\Transfer\SpyGiftCardProductAbstractConfigurationEntityTransfer
     */
    public function mapEntityToTransfer(
        SpyGiftCardProductAbstractConfiguration $entity,
        SpyGiftCardProductAbstractConfigurationEntityTransfer $transfer
    ): SpyGiftCardProductAbstractConfigurationEntityTransfer;
}
