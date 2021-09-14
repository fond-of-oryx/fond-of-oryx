<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface OneTimePasswordEncoderInterface
{
    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return string|null
     */
    public function encode(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): ?string;
}
