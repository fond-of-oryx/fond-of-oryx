<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use Generated\Shared\Transfer\JellyfishCreditMemoTransfer;
use Psr\Http\Message\StreamInterface;

interface CreditMemoAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer
     *
     * @throws \FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(JellyfishCreditMemoTransfer $jellyfishCreditMemoTransfer): ?StreamInterface;
}
