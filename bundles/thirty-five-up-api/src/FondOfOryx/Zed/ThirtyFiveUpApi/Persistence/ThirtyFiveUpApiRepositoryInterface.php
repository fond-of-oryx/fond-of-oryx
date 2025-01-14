<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer;

interface ThirtyFiveUpApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer $orderEntityTransfer
     *
     * @throws \FondOfOryx\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function convert(FooThirtyFiveUpOrderEntityTransfer $orderEntityTransfer): ApiItemTransfer;
}
