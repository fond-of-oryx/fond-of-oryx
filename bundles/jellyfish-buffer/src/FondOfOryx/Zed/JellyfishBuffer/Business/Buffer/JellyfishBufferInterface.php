<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface JellyfishBufferInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     * @param array $options
     *
     * @return void
     */
    public function buffer(AbstractTransfer $transfer, array $options): void;
}
