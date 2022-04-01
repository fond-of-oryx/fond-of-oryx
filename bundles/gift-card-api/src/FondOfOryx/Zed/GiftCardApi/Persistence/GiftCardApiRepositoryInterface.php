<?php

namespace FondOfOryx\Zed\GiftCardApi\Persistence;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\GiftCardTransfer;

interface GiftCardApiRepositoryInterface
{
    /**
     * @param string $code
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer|null
     */
    public function findGiftCardByCode(string $code): ?GiftCardTransfer;

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findByApiRequest(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;
}
