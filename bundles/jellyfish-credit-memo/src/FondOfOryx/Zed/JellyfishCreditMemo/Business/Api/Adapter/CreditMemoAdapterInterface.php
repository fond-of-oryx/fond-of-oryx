<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface CreditMemoAdapterInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AbstractTransfer $transfer): ?StreamInterface;
}
